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
        'theme'  => [
            'text'  => '<i class="fa fa-home fa"></i>',
            'url'   => $this->di->get('url')->create(''),
            'title' => 'Förstasidan',
        ],

        'questions' => [
            'text' => 'Frågor',
            'url' => $this->di->get('url')->create('questions'),
            'title' => 'Se frågor',
        ],

        'tags' => [
            'text' => 'Taggar',
            'url' => $this->di->get('url')->create('tags'),
            'title' => 'Se taggar',
        ],

        'users' => [
            'text' => 'Användare',
            'url' => $this->di->get('url')->create('users'),
            'title' => 'Se användare',
        ],

        'about' => [
            'text' => 'Om oss',
            'url' => $this->di->get('url')->create('about'),
            'title' => 'Lär dig mer om hur sidan fungerar',
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
