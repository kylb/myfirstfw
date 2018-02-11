<?php
return [
    /*
     * Option: (mysql,sqlite)
     */
    //'baseModel' => 'illuminate',

    'driver' => 'mysql',

    'sqlite' => [
        'database' => 'database.db'
    ],

    'mysql' => [
        'host' => 'localhost',
        'database' => 'myfirstfw',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'collation' =>'utf8_unicode_ci'
    ]
];
