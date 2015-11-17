<?php

namespace Anax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class FormSmallController
{
    use \Anax\DI\TInjectionaware;



    /**
     * Index action using external form.
     *
     */
    public function indexAction()
    {
        $this->di->session();

        $form = new \Anax\HTMLForm\CFormExample();
        $form->setDI($this->di);
        $form->check();

        $this->di->theme->setTitle("Testing CForm with Anax");
        $this->di->views->add('default/page', [
            'title' => "Try out a form using CForm",
            'content' => $form->getHTML()
        ]);
    }

    public function signupAction()
    {
        $this->di->session();

        $form = new \Anax\HTMLForm\CFormSignup();
        $form->setDI($this->di);
        $form->check();

        $this->di->theme->setTitle("Skapa ny användare");
        $this->di->views->add('default/page', [
            'title' => "Lägg till användare",
            'content' => $form->getHTML()
        ]);
    }

    public function formUpdateAction($acronym = , $name, $email, $id)
    {
        $this->di->session();

        $form = new \Anax\HTMLForm\CFormUpdate($acronym, $name, $email, $id);
        $form->setDI($this->di);
        $form->check();

        $this->di->theme->setTitle("Redigera användare");
        $this->di->views->add('default/page', [
            'title' => "Redigera",
            'content' => $form->getHTML()
        ]);
    }
}
