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
            'text'  => '<i class="fa fa-plus-square"></i> Tema',
            'url'   => $this->di->get('url')->create('theme.php'),
            'title' => 'Mitt tema',

            // Here we add the submenu, with some menu items, as part of a existing menu item
            'submenu' => [

                'items' => [

                    // This is a menu item of the submenu
                    'regions'  => [
                        'text'  => 'Regioner',
                        'url'   => $this->di->get('url')->create('theme.php/regioner'),
                        'title' => 'Se de olika regionerna'
                    ],

                    // This is a menu item of the submenu
                    'typography'  => [
                        'text'  => 'Typografi',
                        'url'   => $this->di->get('url')->asset('theme.php/typografi'),
                        'title' => 'Exempel på typografi',
                        //'class' => 'italic'
                    ],

                    // This is a menu item of the submenu
                    'font-awesome'  => [
                        'text'  => 'Font Awesome',
                        'url'   => $this->di->get('url')->asset('theme.php/fontawesome'),
                        'title' => 'Exempel på Font Awesome-ikoner',
                    ],
                ],
            ],
        ],

        // This is a menu item
        /*'theme'  => [
            'text'  => 'Tema',
            'url'   => $this->di->get('url')->create('theme.php'),
            'title' => 'Om mig, startsidan'
        ],*/

        // This is a menu item
        'mepage'  => [
            'text'  => '<i class="fa fa-home"></i> Hem',
            'url'   => $this->di->get('url')->create(''),
            'title' => 'Mina redovisningar',

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
