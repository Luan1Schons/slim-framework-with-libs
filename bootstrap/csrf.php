<?php

use Slim\Csrf\Guard;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

$container->set('csrf', function () use ($app) {
    $guard = new Guard($app->getResponseFactory());
    $guard->setFailureHandler(function (Request $request, RequestHandler $handler) {
        $request = $request->withAttribute("csrf_status", false);
        return $handler->handle($request);
    });
    return $guard;
});
