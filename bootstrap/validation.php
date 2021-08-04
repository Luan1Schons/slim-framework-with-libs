<?php

use Psr\Container\ContainerInterface;
use SlimMonsterKit\Validation\Validator;

$container->set('validator', function (ContainerInterface $c) {
    return new Validator;
});
