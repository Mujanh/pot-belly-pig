<?php

namespace Anax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class CFormAddComment extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;


    /**
     * Constructor
     *
     */
    public function __construct($acronym, $ip)
    {
        parent::__construct([], [
            'ip' => [
                'type'        => 'hidden',
                'value'       => $ip,
            ],

            'content' => [
                'type'        => 'textarea',
                'label'       => 'Din kommentar:',
                'required'    => true,
                'validation'  => ['not_empty'],
                'class'       => 'commentContent'
            ],
            'author' => [
                'type'        => 'hidden',
                'value'       => $acronym,
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
        $this->AddOutput("<p><i>DoSubmit(): Form was submitted. Do stuff (save to database) and return true (success) or false (failed processing form)</i></p>");
        //$this->AddOutput("<p><b>Name: " . $this->Value('name') . "</b></p>");
        //$this->AddOutput("<p><b>Email: " . $this->Value('email') . "</b></p>");
        //$this->AddOutput("<p><b>Phone: " . $this->Value('phone') . "</b></p>");

        date_default_timezone_set('Europe/Berlin');
        $now = date('Y-m-d H:i:s');
        //$ip = $this->request->getServer('REMOTE_ADDR');

        $this->comment = new \Anax\Comment\Comment();
        $this->comment->setDI($this->di);
        $addComment = $this->comment->save([
            'pagekey' => $this->Value('pagekey'),
            'content' => $this->Value('content'),
            'name' => $this->Value('name'),
            'web' => $this->Value('web'),
            'email' => $this->Value('email'),
            'timestamp' => $now,
            'ip' => $this->Value('ip'),
            'gravatar' => 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($this->Value('email')))) . '.jpg',
        ]);

        //$this->saveInSession = true;
        if ($addComment) {
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
        $this->AddOUtput("<p><i>Form was submitted and the callback method returned true.</i></p>");
        $this->redirectTo();

    }



    /**
     * Callback What to do when form could not be processed?
     *
     */
    public function callbackFail()
    {
        $this->AddOutput("<p><i>Form was submitted and the Check() method returned false.</i></p>");
        $this->redirectTo();
    }
}
