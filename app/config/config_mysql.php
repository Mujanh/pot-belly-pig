<?php
define('DB_USER', 'USERNAME'); //Change to your mysql username
define('DB_PASSWORD', 'PASSWORD'); //Change to your mysql password
return [

    // Set up details on how to connect to the database
    'dsn'     => "mysql:host=YOURHOST;dbname=YOURDATABASENAME;", //Add your mysql host and databasename
    'username'        => DB_USER,
    'password'        => DB_PASSWORD,
    'driver_options'  => [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
    'table_prefix'    => "project_", //Change this to whatever table prefix you use

    // Display details on what happens
    //'verbose' => true,

    // Throw a more verbose exception when failing to connect
    //'debug_connect' => 'true',
];
