<?php

use League\Flysystem\Filesystem;
use Psr\Container\ContainerInterface;
use SlimMonsterKit\Storage\Adapter;


$container->set('fs', function (ContainerInterface $c) {
    $adapter = new Adapter($c, __DIR__ . '/../storage');
    return new Filesystem($adapter->getAdapter(), [
        'case_sensitive' => $adapter->getSensitive()
    ]);
});
