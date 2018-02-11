<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$conf = require_once __DIR__ . "/../app/database.php";
$capsule = new Capsule;

$capsule = new Capsule;

if($conf['driver'] == 'mysql'){
    $capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => $conf['mysql']['host'],
        'database'  => $conf['mysql']['database'],
        'username'  => $conf['mysql']['username'],
        'password'  => $conf['mysql']['password'],
        'charset'   => $conf['mysql']['charset'],
        'collation' => $conf['mysql']['collation'],
        'prefix'    => ''
    ]);
}
else if($conf['driver'] == 'sqlite'){
    $capsule->addConnection([
        'driver' => 'sqlite',
        'database' => __DIR__ . "/../storage/database/". $conf['sqlite']['database']
    ]);
}
$capsule->setAsGlobal();
$capsule->bootEloquent();