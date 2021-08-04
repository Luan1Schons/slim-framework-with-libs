<?php

use Psr\Http\Message\ServerRequestInterface;

$customErrorHandler = function (
    ServerRequestInterface $request,
    Throwable $exception,
    bool $displayErrorDetails,
    bool $logErrors,
    bool $logErrorDetais
) use ($app) {
    $response = $app->getResponseFactory()->createResponse();
    if (strrpos($request->getUri()->getPath(), "/api") === false) {
        if ($exception->getCode() == 404) {
            return $app->getContainer()
                ->get('view')
                ->render($response, '404.html', [
                    'title' => 'Error 404',
                    'text' => 'Page Not Found!'
                ]);
        }

        return $app->getContainer()
            ->get('view')
            ->render($response, '500.html', [
                'title' => 'Php Error Server',
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString()
            ]);
    }

    if ($exception->getCode() == 404) {
        $response->getBody()
            ->write(json_encode(['error' => 'Page Not Found!']));

        return $response->withStatus(404)
            ->withHeader('Content-Type', 'application/json');
    }

    $response->getBody()
        ->write(json_encode([
            'error' => 'Php Error Server',
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString()
        ]));

    return $response->withStatus(500)
        ->withHeader('Content-Type', 'application/json');
};

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);
