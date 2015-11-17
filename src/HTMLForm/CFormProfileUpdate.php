<?php

namespace Anax\HTMLForm;

/**
 * Form to update profile info.
 *
 */
class CFormProfileUpdate extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;



    /**
     * Constructor
     *
     */
    public function __construct($id, $profile, $email, $acronym)
    {
        parent::__construct([], [

            'profile' => [
                'class'       => 'editProfileContent',
                'type'        => 'textarea',
                'label'       => 'Din profiltext:',
                'value'       => $profile,
            ],
            'email' => [
                'type'        => 'text',
                'value'       => $email,
                'required'    => true,
                'validation'  => ['not_empty', 'email_adress'],
            ],
            'submit' => [
                'class'     => 'editProfileButton',
                'type'      => 'submit',
                'value'     => 'Spara',
                'callback'  => [$this, 'callbackSubmit'],
            ],

            'reset' => [
                'class'     => 'editProfileButton',
                'type'      => 'reset',
                'value'  => 'Rensa',
            ],
        ]);

        $this->id = $id;
        $this->acronym = $acronym;
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

        $this->user = new \Anax\Users\User();
        $this->user->setDI($this->di);

        //Save to database
        $updateProfile = $this->user->save([
            'id'  => $this->id,
            'profile' => $this->Value('profile'),
            'email' => $this->Value('email'),
        ]);

        //If saved successfully
        if ($updateProfile)
            return true;
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
        $url = 'users/view/' . $this->id;
        $this->redirectTo($url);

    }



    /**
     * Callback What to do when form could not be processed?
     *
     */
    public function callbackFail()
    {
        $this->AddOutput("<p><i>Gick inte att spara profilen. Pröva igen.");
        $this->redirectTo();
    }
}
