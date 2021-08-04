<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;


$container->set('logger', function ($c) {
    $logger = new Logger($c->get('settings')['app']['name']);
    $filename = date('Ymd') . '_' . strtolower(trim($c->get('settings')['app']['name']));
    $fileHandler = new StreamHandler(
        __DIR__ . '/../storage/logs/' . $filename . '.log'
    );
    $logger->pushHandler($fileHandler);
    return $logger;
});
