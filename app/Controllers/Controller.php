<?php

namespace SlimMonsterKit\Controllers;

use Slim\Psr7\Response;

class Controller
{
    protected $container;

    public function __construct($container)
    {
        $this->response = new Response;
        $this->container = $container;
    }

    public function withJson($data, int $status = 200)
    {
        $this->response->getBody()
            ->write(json_encode($data));

        return $this->response->withStatus($status)
            ->withHeader('Content-Type', 'application/json');
    }

    public function log(string $title, array $data = [], string $type = 'info')
    {
        $this->logger->{$type}($title, $data);
    }

    public function __get($property)
    {
        if ($this->container->get($property)) {
            return $this->container->get($property);
        }
    }
}
