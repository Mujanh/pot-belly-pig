<?php
/**
 * Config-file for Anax, theme related settings, return it all as array.
 *
 */

return [

    /**
     * Settings for Which theme to use, theme directory is found by path and name.
     *
     * path: where is the base path to the theme directory, end with a slash.
     * name: name of the theme is mapped to a directory right below the path.
     */
    'settings' => [
        'path' => ANAX_INSTALL_PATH . 'theme/',
        'name' => 'anax-grid',
    ],


    /**
     * Add default views.
     */
    'views' => [

        //Aboveheader view
        [
        	'region' => 'aboveheader',
            'template' => 'me/aboveheader',
            'data' => [
            	'loggedIn' => $this->di->session->has('user'),
            ],
            'sort' => -1
        ],
    	//Header view
        [
        	'region' => 'header',
            'template' => 'me/header',
            'data' => [
            	'siteTitle' => "Allt om hängbukssvin",
            	'siteTagline' => "För allt du vill veta om hängbukssvin",
            ],
            'sort' => -1
        ],

        //Footer view
        ['region' => 'footer', 'template' => 'me/footer', 'data' => [], 'sort' => -1],

        //Navbar view
        [
        	'region' => 'navbar',
            'template' => [
            	'callback' => function() {
            		return $this->di->navbar->create();
            	},
            ],
            'data' => [],
            'sort' => -1
        ],
    ],


    /**
     * Data to extract and send as variables to the main template file.
     */
    'data' => [

        // Class for color theme (available: happy and neutral) in html element
        'html_class' => 'neutral',

        // Class for body element
        'body_class' => '',

        // Language for this page.
        'lang' => 'sv',

        // Append this value to each <title>
        'title_append' => ' | Allt om hängbukssvin',

        // Stylesheets
        'stylesheets' => ['css/anax-grid/style.php'],

        // Inline style
        'style' => null,

        // Favicon
        'favicon' => 'favicon.ico',

        // Path to modernizr or null to disable
        'modernizr' => 'js/modernizr.js',

        // Path to jquery or null to disable
        'jquery' => '//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js',

        // Array with javscript-files to include
        'javascript_include' => ['js/showmessages.js'],

        // Use google analytics for tracking, set key or null to disable
        'google_analytics' => null,
    ],
];
