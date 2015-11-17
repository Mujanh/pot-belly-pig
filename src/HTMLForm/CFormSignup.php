<?php

namespace Anax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class CFormSignup extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;



    /**
     * Constructor
     *
     */
    public function __construct()
    {
        parent::__construct([], [
            'acronym' => [
                'type'        => 'text',
                'label'       => 'Användarnamn:',
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
            'name' => [
                'type'        => 'text',
                'label'       => 'Namn:',
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
            'email' => [
                'type'        => 'email',
                'label'       => 'E-post:',
                'required'    => true,
                'validation'  => ['not_empty', 'email_adress'],
            ],
            'password' => [
                'type'        => 'password',
                'label'       => 'Lösenord:',
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
            'submit' => [
                'class'     => 'signupButton',
                'type'      => 'submit',
                'value'     => 'Skapa användare',
                'callback'  => [$this, 'callbackSubmit'],
            ],

            'reset' => [
                'class'     => 'signupButton',
                'type'      => 'reset',
                'value'  => 'Rensa',
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
        date_default_timezone_set('Europe/Berlin');
        $now = date('Y-m-d H:i:s');

        $gravatar = 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($this->Value('email')))) . '.jpg';

        $this->user = new \Anax\Users\User();
        $this->user->setDI($this->di);

        //Is the acronym already used by anoter user?
        $isAcronymTaken = $this->user->query()
            ->where('acronym = ?')
            ->execute(array($this->Value('acronym')));

        //If acronym is not taken, create new user in database
        if (empty($isAcronymTaken)) {
            $addUser = $this->user->save([
                'acronym' => $this->Value('acronym'),
                'email' => $this->Value('email'),
                'name' => $this->Value('name'),
                'gravatar' => $gravatar,
                'password' => password_hash($this->Value('password'), PASSWORD_DEFAULT),
                'created' => $now,
            ]);

            //If created successfully
            if ($addUser) {
                return true;
            }
            else {
                return false;
            }

        //If username is taken, inform the user    
        } else {
            $this->AddOutput("<p><i>Användarnamn upptaget</i></p>");
            return false;
        }
    }


    /**
     * Callback What to do if the form was submitted?
     *
     */
    public function callbackSuccess()
    {

        $this->redirectTo('login');

    }



    /**
     * Callback What to do when form could not be processed?
     *
     */
    public function callbackFail()
    {
        $this->AddOutput("<p><i>Misslyckades att skapa användare.</i></p>");
        $this->redirectTo();
    }
}
