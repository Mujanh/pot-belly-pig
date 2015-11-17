<?php

namespace Anax\HTMLForm;

/**
 * Form to add a comment to a question or an answer
 *
 */
class CFormAddCommentQuestion extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;

    protected $questionId = null;
    protected $answerId = null;
    protected $acronym;

    /**
     * Constructor
     *
     */
    public function __construct($acronym, $questionId, $answerId, $userId)
    {
        parent::__construct([], [

            'content' => [
                'type'        => 'textarea',
                'label'       => 'Din kommentar:',
                'required'    => true,
                'validation'  => ['not_empty'],
                'class'       => 'commentContent'
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

        $this->acronym = $acronym; //logged in user
        $this->questionId = $questionId; //id of question being commented
        $this->answerId = $answerId; //id of answer being commented
        $this->userId = $userId; //id of user answering question
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

        $this->comment = new \Anax\Questions\Comments();
        $this->comment->setDI($this->di);

        //Save comment to database
        $addComment = $this->comment->save([
            'content' => $this->Value('content'),
            'author' => $this->acronym,
            'userId' => $this->userId,
            'timestamp' => $now,
            'questionId' => $this->questionId,
            'answerId' => $this->answerId,
        ]);

        //If saved succesfully, add points to user's activity score for commenting
        if ($addComment) {
            $this->user = new \Anax\Users\User();
            $this->user->setDI($this->di);

            $userInfo = $this->user->find($this->userId);

            $score = $userInfo->activityScore + 3;

            $this->user->save([
                'id' => $userInfo->id,
                'activityScore' => $score
            ]);

            return true;
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
        //Redirect back to question
        $this->redirectTo("question/view/" . $this->questionId);

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
