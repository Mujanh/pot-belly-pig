<?php

namespace Anax\HTMLForm;

/**
 * Form to answer a question
 *
 */
class CFormAnswerQuestion extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;

    protected $acronym;
    protected $questionId;
    protected $gravatar;

    /**
     * Constructor
     *
     */
    public function __construct($acronym, $questionId, $gravatar, $userId)
    {
        parent::__construct([], [

            'content' => [
                'type'        => 'textarea',
                'label'       => 'Ditt svar:',
                'required'    => true,
                'validation'  => ['not_empty'],
                'class'       => 'answerForm'
            ],

            'submit' => [
                'type'      => 'submit',
                'value'     => 'Svara',
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
        $this->questionId = $questionId;
        $this->gravatar = $gravatar;
        $this->userId = $userId;
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

        $this->answer = new \Anax\Questions\Answers();
        $this->answer->setDI($this->di);

        //Save to database
        $addAnswer = $this->answer->save([
            'questionId' => $this->questionId,
            'content' => $this->Value('content'),
            'author' => $this->acronym,
            'userId' => $this->userId,
            'timestamp' => $now,
            'gravatar' => $this->gravatar,
        ]);

        //If saved successfully, add points to user's activity score
        if ($addAnswer) {
            $this->user = new \Anax\Users\User();
            $this->user->setDI($this->di);

            $userInfo = $this->user->find($this->userId);

            $score = $userInfo->activityScore + 8;

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
        $this->redirectTo();

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
