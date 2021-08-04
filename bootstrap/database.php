<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$container->set('db', function ($c) {
    $capsule = new Capsule;
    $capsule->addConnection($c->get('settings')['db']);
    $capsule->setAsGlobal();
    return $capsule;
});
$container->get('db')->bootEloquent();
