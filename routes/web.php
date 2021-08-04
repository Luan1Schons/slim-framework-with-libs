<?php

$app->get('/mail/test', 'Web.MailTestController:send')->setName('home');
$app->get('[/]', 'Web.HomeController:index')->setName('home');
