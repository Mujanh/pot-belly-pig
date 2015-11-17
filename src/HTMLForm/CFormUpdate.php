<?php

namespace Anax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class CFormUpdate extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;



    /**
     * Constructor
     *
     */
    public function __construct($id, $acronym, $name, $email)
    {
        parent::__construct([], [
            'id' => [
                'type'  => 'hidden',
                'value'       => $id,
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
            'acronym' => [
                'type'        => 'text',
                'label'       => 'Din akronym:',
                'value'       => $acronym,
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
            'name' => [
                'type'        => 'text',
                'label'       => 'Ditt namn:',
                'value'       => $name,
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
            'email' => [
                'type'        => 'text',
                'value'       => $email,
                'required'    => true,
                'validation'  => ['not_empty', 'email_adress'],
            ],
            'submit' => [
                'type'      => 'submit',
                'callback'  => [$this, 'callbackSubmit'],
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
        
        $this->user = new \Anax\Users\User();
        $this->user->setDI($this->di);
        $addUser = $this->user->save([
            'id'  => $this->Value('id'),
            'acronym' => $this->Value('acronym'),
            'email' => $this->Value('email'),
            'name' => $this->Value('name'),
            'password' => password_hash($this->Value('acronym'), PASSWORD_DEFAULT),
        ]);

        //$this->saveInSession = true;
        if ($addUser)
            return true;
        else {
            return false;
        }
    }



    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmitFail()
    {
        $this->AddOutput("<p><i>DoSubmitFail(): Form was submitted but I failed to process/save/validate it</i></p>");
        return false;
    }



    /**
     * Callback What to do if the form was submitted?
     *
     */
    public function callbackSuccess()
    {
        $this->AddOUtput("<p><i>Form was submitted and the callback method returned true.</i></p>");
        $url = 'users/id/' . $this->Value('id');
        $this->redirectTo($url);

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
