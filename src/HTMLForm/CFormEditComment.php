<?php

namespace Anax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class CFormEditComment extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;


    /**
     * Constructor
     *
     */
    public function __construct($id, $content, $name, $web, $email, $key)
    {
        parent::__construct([], [
            'pagekey' => [
                'type'        => 'hidden',
                'value'       => $key,
            ],
            'id' => [
                'type'        => 'hidden',
                'value'       => $id,
            ],
            'content' => [
                'type'        => 'textarea',
                'label'       => 'Din kommentar:',
                'value'       => $content,
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
            'web' => [
                'type'        => 'url',
                'value'       => $web,
                'label'       => 'Din hemsida:',
                //'validation'  => ['not_empty'],
            ],
            'email' => [
                'type'        => 'email',
                'value'       => $email,
                'label'       => 'Din email-adress:',
                //'validation'  => ['not_empty', 'email_adress'],
            ],
            'submit' => [
                'type'      => 'submit',
                'value'     => 'Spara',
                'callback'  => [$this, 'callbackSubmit'],
            ],
            'reset' => [
                'type'      => 'reset',
                'value'     => 'Återställ',
            ],
            'delete' => [
                'type'      => 'submit',
                'value'     => 'Radera inlägg',
                'callback'  => [$this, 'callbackSubmitDelete'],
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
        $editComment = $this->comment->save([
            'id'  => $this->Value('id'),
            'content' => $this->Value('content'),
            'name' => $this->Value('name'),
            'web' => $this->Value('web'),
            'email' => $this->Value('email'),
            'gravatar' => 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($this->Value('email')))) . '.jpg',
        ]);

        //$this->saveInSession = true;
        if ($editComment) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmitDelete()
    {
        $this->comments = new \Anax\Comment\Comment();
        $this->comments->setDI($this->di);

        $res = $this->comments->delete($this->Value('id'));

        return $res ? true : false;
    }

    /**
     * Callback What to do if the form was submitted?
     *
     */
    public function callbackSuccess()
    {
        $this->AddOUtput("<p><i>Form was submitted and the callback method returned true.</i></p>");
        $url = $this->Value('pagekey') == 'comment-page' ? 'comment' : '';
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
