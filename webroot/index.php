<?php
/**
 * This is a Anax pagecontroller.
 *
 */

// Get environment & autoloader and the $app-object.
require __DIR__.'/config_with_app.php';


// Read config for theme
$app->theme->configure(ANAX_APP_PATH . 'config/theme-grid.php');

//Set clean urls
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

// Read config for navbar
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_project.php');


/*------- Create services and inject into the app.-------*/

$di->set('QuestionController', function() use ($di) {
    $controller = new \Anax\Questions\QuestionController();
    $controller->setDI($di);
    return $controller;
});

$di->set('TagsController', function() use ($di) {
    $controller = new \Anax\Questions\TagsController();
    $controller->setDI($di);
    return $controller;
});

$di->set('UsersController', function() use ($di) {
    $controller = new \Anax\Users\UsersController();
    $controller->setDI($di);
    return $controller;
});

$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/config_mysql.php'); //online
    //$db->setOptions(require ANAX_APP_PATH . 'config/config_mysql_local.php'); //offline
    $db->connect();
    return $db;
});

$di->set('form', '\Mos\HTMLForm\CForm');


// Route to start page
$app->router->add('', function() use ($app) {
		$app->theme->setTitle("Välkommen");

		$app->dispatcher->forward([
			'controller' => 'question',
			'action'     => 'viewLatest',
		]);

        $app->dispatcher->forward([
            'controller' => 'tags',
            'action'     => 'viewMostPopular',
        ]);

        $app->dispatcher->forward([
            'controller' => 'users',
            'action'     => 'viewMostActive',
        ]);

});

//Route to question page
$app->router->add('questions', function() use ($app) {

    $app->theme->setTitle("Frågor om hängbukssvin");
    $app->dispatcher->forward([
        'controller' => 'question',
        'action'     => 'view-all',
    ]);

});

//Route to login page
$app->router->add('login', function() use ($app) {

    $app->theme->setTitle("Logga in");
    $app->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'login',
    ]);

});

//Route to logout
$app->router->add('logout', function() use ($app) {

    $app->theme->setTitle("Logga in");
    $app->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'login',
    ]);

});

//Route to user page
$app->router->add('users', function() use ($app) {
    $app->theme->setTitle("Användare");
    $app->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'view-all',
    ]);
});

//Route to signup page
$app->router->add('create', function() use ($app) {
    $app->theme->setTitle("Skapa ny användare");
    $app->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'add',
    ]);
});

//Route to tag page
$app->router->add('tags', function() use ($app) {
    $app->theme->setTitle("Se alla taggar");
    $app->dispatcher->forward([
        'controller' => 'tags',
        'action'     => 'view-all',
    ]);
});

//Route to about page
$app->router->add('about', function() use ($app) {

    $app->theme->setTitle("Om oss");
    $content = $app->fileContent->get('about_us.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');

    $app->views->add('default/page', [
        'content' => $content,
        'class'     => 'aboutpage',
    ]);
});


//Render routes using router engine
$app->router->handle();
// Render the response using theme engine.
$app->theme->render();
