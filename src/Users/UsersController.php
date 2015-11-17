<?php

namespace Anax\Users;

/**
 * A controller for users
 *
 */
class UsersController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    /**
     * Initialize the controller.
     *
     * @return void
     */
    public function initialize()
    {
        $this->users = new \Anax\Users\User();
        $this->users->setDI($this->di);

        $this->activity = new \Anax\Users\Vactivity();
        $this->activity->setDI($this->di);

    }

    /**
     * View all users.
     *
     * @return void
     */
    public function viewAllAction()
    {
        //Get all users from database
        $all = $this->users->findAll();

        //Get user activity from database
        $activity = $this->activity->findAll();

        //Add to view
        $this->theme->setTitle("Alla användare");
        $this->views->add('users/view-all', [
            'users' => $all,
            'title' => "Alla användare",
            'activities' => $activity
        ]);

        //Show the top 5 most active users in sidebar
        $this->viewMostActiveAction();
    }

    /**
    * View the 5 most active users (highest activity score)
    *
    * @return void
    */
    public function viewMostActiveAction() {

        //Get the 5 most active users based on activity score
        $activity = $this->activity->query()
            ->orderBy('activityScore DESC')
            ->limit('5')
            ->execute();

        //Add to view in sidebar
        $this->views->add('questions/firstpageUsers', [
            'users' => $activity,
        ], 'sidebar');

    }

    /**
     * View user with specific id.
     *
     * @param int $id of user to display
     *
     * @return void
     */
    public function viewAction($id)
    {
        if (!isset($id)) {
            die("Missing id");
        }

        //Get user details from database
        $user = $this->users->find($id);

        //Did the query return any rows?
        if($user) {

            //Check if a user is logged in
            $loggedIn = $this->authenticateAction() ? $this->session->get('user') : null;

            //Get the chosen user's activity score
            $activity = $this->activity->find($id);

            //Calculate the user's reputation
            $rankScore = ($activity->questionScore + $activity->answerScore + $activity->commentScore);
            $totalScore = $rankScore + $activity->activityScore;

            //Add user's profile to view
            $this->theme->setTitle("Se användarprofil");
            $this->views->add('users/profile', [
                'user' => $user,
                'currentUser' => $loggedIn,
                'activity'  => $activity,
                'reputation' => $totalScore
            ]);

            //Add 5 latest questions by user to view
            $this->dispatcher->forward([
                'controller' => 'question',
                'action'     => 'latestUserQuestions',
                'params'     => [$user->id]
            ]);

            //Add 5 latest answers by user to view
            $this->dispatcher->forward([
                'controller' => 'question',
                'action'     => 'latestUserAnswers',
                'params'     => [$user->id]
            ]);

        //If no rows were found, show info message
        } else {
            $this->theme->setTitle("Se användarprofil");
            $this->views->add('default/page', [
                'title' => "Misslyckades",
                'content' => "Ingen användare med det id hittades."
            ]);
        }
    }


    /**
     * Add new user.
     *
     * @return void
     */
    public function addAction()
    {
        //Check if user is already logged in
        if (!$this->authenticateAction()) {

            //If not logged in, show signup form
            $form = new \Anax\HTMLForm\CFormSignup();
            $form->setDI($this->di);
            $test = $form->check();

            //Add form to view
            $this->di->theme->setTitle("Lägg till ny användare");
            $this->di->views->add('default/page', [
                'title' => "Lägg till ny användare",
                'content' => $form->getHTML() . "<p>Redan medlem? <a href='" . $this->url->create('login') . "'
title='Logga in som medlem'>Logga in här</a></p>"
        ]);

        //If already logged in, ask user to log out before signing up
        } else {
            $this->di->views->add('default/page', [
                'title' => "Lägg till ny användare",
                'content' => "Du är redan inloggad, <a href='" . $this->url->create('users/logout') . "'>logga ut</a> för att skapa ny användare."
        ]);

        }
    }

    /**
    * Login an existing user
    *
    * @return void
    */
    public function loginAction() {

        //Check if user is already logged in
        if (!$this->authenticateAction()) {

            //If not logged in, show login form
            $form = new \Anax\HTMLForm\CFormLogin();
            $form->setDI($this->di);
            $form->check();

            //Add form to view
            $this->di->theme->setTitle("Logga in");
            $this->di->views->add('default/page', [
                'title' => "Logga in",
                'content' => $form->getHTML() . "<p>Inte medlem än? <a href='" . $this->url->create('create') . "'
title='Skapa ny användare'>Bli medlem här</a></p>"
        ]);

        //If already logged in, redirect user to user's profile
        } else {

            //Get the user details about logged in user
            $acronym = $this->session->get('user');

            $user = $this->users->query()
                ->where('acronym = ?')
                ->execute(array($acronym));

            //Redirect user to profile
            $url = "users/view/" . $user[0]->id;
            $this->response->redirect($url);

        }

    }

    /**
    * Check if user is logged in
    */
    public function authenticateAction() {
        return $this->session->has('user');
    }

    /**
    * Logout user
    */
    public function logoutAction() {
        $this->session->remove('user');
        $url = $this->url->create('login');
        $this->response->redirect($url);
    }

    /**
     * Update user's profile
     *
     * @return void
     */
    public function updateAction()
    {
        //Check if user is logged in
        if (!$this->session->has('user')) {
            die("You have to be logged in to update your profile.");
        }

        $acronym = $this->session->get('user');

        //Get user details about logged in user
        $user = $this->users->query()
            ->where('acronym = ?')
            ->execute(array($acronym));

        //Was the user found in database
        if ($user[0]) {

            //Get current profile text, email and user id
            $profile = $user[0]->profile;
            $email = $user[0]->email;
            $id = $user[0]->id;

            //Add form to update profile
            $form = new \Anax\HTMLForm\CFormProfileUpdate($id, $profile, $email, $acronym);
            $form->setDI($this->di);
            $status = $form->check();

            //Add to view
            $this->di->theme->setTitle("Redigera profil för " . $user[0]->acronym);
            $this->di->views->add('default/page', [
                'title' => "Redigera profiltext",
                'content' => $form->getHTML()
            ]);

        //If user was not found, show info message
        } else {
            $this->di->theme->setTitle("Redigera profil");
            $this->di->views->add('default/page', [
                'title' => "Redigera användare",
                'content' => "Hittar inte den efterfrågade användaren"
            ]);
        }
    }

}
