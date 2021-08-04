<?php

use Slim\Views\Twig;

$container->set('view', function ($c) {
    $twig = Twig::create(
        __DIR__ . '/../resources/views',
        [
            'cache' => $c->get('settings')['app']['debug']
                ? false
                : __DIR__ . '/../storage/cache'
        ]
    );
    $twig->getEnvironment()->addGlobal('app_name', $c->get('settings')['app']['name']);
    return $twig;
});
