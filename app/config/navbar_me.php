<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'navbar',

    // Here comes the menu strcture
    'items' => [

        // This is a menu item
        'home'  => [
            'text'  => 'Hem',
            'url'   => $this->di->get('url')->create(''),
            'title' => 'Om mig, startsidan'
        ],

        // This is a menu item
        'redovisning'  => [
            'text'  => 'Redovisning',
            'url'   => $this->di->get('url')->create('redovisning'),
            'title' => 'Mina redovisningar',

        ],

        'dice' => [
        	'text' => 'Tärning',
        	'url' => $this->di->get('url')->create('dice'),
        	'title' => 'Kasta tärning',
        ],

        'comment' => [
            'text'  =>'Kommentarer',
            'url'   => $this->di->get('url')->create('comment'),
            'title' => 'Lämna kommentarer'
        ],

        'theme' => [
            'text'  =>'Tema',
            'url'   => $this->di->get('url')->create('theme.php'),
            'title' => 'Mitt tema'
        ],

        'users' => [
            'text'  =>'Användare',
            'url'   => $this->di->get('url')->create('users'),
            'title' => 'Användare'
        ],

        'table' => [
            'text'  =>'Modul',
            'url'   => $this->di->get('url')->create('table'),
            'title' => 'Min modul - en HTML Helper för Tables'
        ],

        // This is a menu item
        'source' => [
            'text'  =>'Källkod',
            'url'   => $this->di->get('url')->create('source'),
            'title' => 'Se källkoden till min me-sida'
        ],
    ],



    /**
     * Callback tracing the current selected menu item base on scriptname
     *
     */
    'callback' => function ($url) {
        if ($url == $this->di->get('request')->getCurrentUrl(false)) {
            return true;
        }
    },



    /**
     * Callback to check if current page is a decendant of the menuitem, this check applies for those
     * menuitems that has the setting 'mark-if-parent' set to true.
     *
     */
    'is_parent' => function ($parent) {
        $route = $this->di->get('request')->getRoute();
        return !substr_compare($parent, $route, 0, strlen($parent));
    },



   /**
     * Callback to create the url, if needed, else comment out.
     *
     */
   /*
    'create_url' => function ($url) {
        return $this->di->get('url')->create($url);
    },
    */
];
