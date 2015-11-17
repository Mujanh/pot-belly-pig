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
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_theme.php');

// Router to start page theme
$app->router->add('', function() use ($app) {
    $app->theme->setTitle("Mitt tema");
    $main = $app->fileContent->get('main.html');
    $sidebar = $app->fileContent->get('sidebar.html');

    $app->views->add('default/article', ['content' => $main,])
               ->add('default/article', ['content' => $sidebar,], "sidebar")
               ->addString('<i class="fa fa-users fa-2x"></i> <span>Användarvänligt</span>', 'featured-1')
               ->addString('<i class="fa fa-globe fa-2x"></i> <span>Tilldelade regioner</span>', 'featured-2')
               ->addString('<i class="fa fa-cogs fa-2x"></i> <span>Utbyggbart</span>', 'featured-3')
               ->addString('<i class="fa fa-github fa-3x fa-inverse"></i> <a href="https://github.com/">Github</a>', 'footer-column-1')
               ->addString('<i class="fa fa-stack-overflow fa-3x fa-inverse"></i> <a href="http://stackoverflow.com/">Stackoverflow</a>', 'footer-column-2')
               ->addString('<i class="fa fa-google fa-3x fa-inverse"></i> <a href="http://google.com">Google</a>', 'footer-column-3')
               ->addString('<i class="fa fa-reddit fa-3x fa-inverse"></i> <a href="http://reddit.com/">Reddit</a>', 'footer-column-4');;
});

// Route to page to show regions in theme
$app->router->add('regioner', function() use ($app) {
    $app->theme->setTitle("Regioner");
    $app->theme->addStylesheet('css/anax-grid/regions_demo.css');
    $app->theme->setTitle("Regioner");


    $app->views->addString('flash', 'flash')
               ->addString('featured-1', 'featured-1')
               ->addString('featured-2', 'featured-2')
               ->addString('featured-3', 'featured-3')
               ->addString('main', 'main')
               ->addString('sidebar', 'sidebar')
               ->addString('triptych-1', 'triptych-1')
               ->addString('triptych-2', 'triptych-2')
               ->addString('triptych-3', 'triptych-3')
               ->addString('footer-column-1', 'footer-column-1')
               ->addString('footer-column-2', 'footer-column-2')
               ->addString('footer-column-3', 'footer-column-3')
               ->addString('footer-column-4', 'footer-column-4');

});

//Route to page to show typography in theme
$app->router->add('typografi', function() use ($app) {
    $app->theme->setTitle("Typografi");
    $content = $app->fileContent->get('typography.html');

    $app->views->add('default/article', [
        'content' => $content,
    ]);

    $app->views->add('default/article', [
        'content' => $content,
    ], "sidebar");
});

//Route to page to show fontawesome in theme
$app->router->add('fontawesome', function() use ($app) {
    $app->theme->setTitle("Font Awesome");
    $content = $app->fileContent->get('font-awesome.html');

    $app->views->add('default/article', [
        'content' => $content,
    ]);

    $app->views->add('default/article', [
        'content' => $content,
    ], "sidebar");
});


//Render routes using router engine
$app->router->handle();
// Render the response using theme engine.
$app->theme->render();
