<?php
define('DB_USER', 'USERNAME'); //Change to your username
define('DB_PASSWORD', 'PASSWORD'); //Change to your password
return [

    // Set up details on how to connect to the database
    'dsn'     => "mysql:host=localhost;dbname=test;", //Change if you want to use a different host or databasename
    'username'        => DB_USER,
    'password'        => DB_PASSWORD,
    'driver_options'  => [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
    'table_prefix'    => "test_", //Change if you want to use another prefix

    // Display details on what happens
    //'verbose' => true,

    // Throw a more verbose exception when failing to connect
    //'debug_connect' => 'true',
];
