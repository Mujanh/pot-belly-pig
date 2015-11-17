<?php

namespace Anax\HTMLForm;

/**
 * Form to login
 *
 */
class CFormLogin extends \Mos\HTMLForm\CForm
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
            'password' => [
                'type'        => 'password',
                'label'       => 'Lösenord:',
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
            'submit' => [
                'class'     => 'loginButton',
                'type'      => 'submit',
                'value'     => 'Logga in',
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

        $acronym = $this->Value('acronym');
        $password = password_hash($this->Value('password'), PASSWORD_DEFAULT);

        $this->user = new \Anax\Users\User();
        $this->user->setDI($this->di);

        //Get user from database
        $loginUser = $this->user->query()
            ->where('acronym = ?')
            ->execute(array($acronym));

        //Login user if user was found and password was correct
        if ($loginUser && password_verify($this->Value('password'), $loginUser[0]->password)) {

            $this->user->session->set('user', $acronym);

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

        $this->redirectTo('login');

    }



    /**
     * Callback What to do when form could not be processed?
     *
     */
    public function callbackFail()
    {
        $this->AddOutput("<p><i>Misslyckades att logga in. Pröva igen.</i></p>");
        $this->redirectTo();
    }
}
