<?php

namespace Anax\HTMLForm;

/**
 * Form to add a new question
 *
 */
class CFormAddQuestion extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;

    protected $acronym;

    /**
     * Constructor
     *
     */
    public function __construct($acronym, $tags, $idUser)
    {
        parent::__construct([], [
            'title' => [
                'type'        => 'text',
                'label'       => 'Titel:',
                'required'    => true,
                'validation'  => ['not_empty'],
                'class'       => 'addQuestionTitle'
            ],

            'content' => [
                'type'        => 'textarea',
                'label'       => 'Din fråga:',
                'required'    => true,
                'validation'  => ['not_empty'],
                'class'       => 'addQuestionContent'
            ],

            'tags' => [
                'type'        => 'checkbox-multiple',
                'label'       => 'Välj taggar',
                'values'       => $tags,
                'required'  => true,

            ],

            'submit' => [
                'type'      => 'submit',
                'value'     => 'Spara',
                'callback'  => [$this, 'callbackSubmit'],
                'class'     => 'commentButtons'
            ],
            'reset' => [
                'type'      => 'reset',
                'value'     => 'Ångra',
                'class'     => 'commentButtons'
            ],
        ]);

        $this->acronym = $acronym;
        $this->userId = $idUser;
    }



    /**
     * Customise the check() method.
     *
     * @param callable $callIfSuccess handler to call if function returns true.
     * @param callable $callIfFail    handler to call if function returns true.
     */
    public function check($callIfSuccess = null, $callIfFail = null)
    {
        return parent::check([$this, 'callbackSuccess'], [$this, 'callbackFail']);
    }



    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmit()
    {
        date_default_timezone_set('Europe/Berlin');
        $now = date('Y-m-d H:i:s');

        $this->question = new \Anax\Questions\Question();
        $this->question->setDI($this->di);

        //Save question to database
        $addQuestion = $this->question->save([
            'title' => $this->Value('title'),
            'content' => $this->Value('content'),
            'author' => $this->acronym,
            'userId' => $this->userId,
            'timestamp' => $now,
        ]);

        //If saved successfully, connect the selected tags to the question in database
        if ($addQuestion) {
            $this->question2tags = new \Anax\Questions\Question2Tags();
            $this->question2tags->setDI($this->di);

            $this->tags = new \Anax\Questions\Tags();
            $this->tags->setDI($this->di);

            $Qid = $this->question->returnLastId();
            $categories = $this->tags->findAll();

            $count = 0;

            $myarray = [];

            //Set Övrigt as default tag if none has been chosen
            $tagCategories = !empty($this->Values('tags')) ? $this->Values('tags') : array('Övrigt');

            //Prepare the query
            foreach ($categories AS $id => $cat) {
                if (in_array($cat->tag, $tagCategories)) {
                    array_push($myarray, $cat->id);
                }
            }

            //Save to database
            foreach ($myarray AS $nr => $val) {
                $res = $this->question2tags->create([
                    'idQuestion' => $Qid,
                    'idTag' => $myarray[$nr],
                ]);
            }

            //If saved successfully, add points to user's activityscore
            if ($res) {
                $this->user = new \Anax\Users\User();
                $this->user->setDI($this->di);

                $userInfo = $this->user->query()
                    ->where('acronym = ?')
                    ->execute(array($this->acronym));

                $score = $userInfo[0]->activityScore + 5;

                $this->user->save([
                    'id' => $userInfo[0]->id,
                    'activityScore' => $score
                ]);
                return true;
            } else {
                return false;
            }

            //return true;

        }
        else {
            return false;
        }
    }


    /**
     * Callback What to do if the form was submitted?
     *
     */
    public function callbackSuccess()
    {
        $this->redirectTo("questions");

    }



    /**
     * Callback What to do when form could not be processed?
     *
     */
    public function callbackFail()
    {
        $this->redirectTo();
    }
}
