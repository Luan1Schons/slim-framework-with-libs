<?php

use SlimMonsterKit\Mail\Mailer;

$container->set('mailer', function ($c) {
    if ($c->get('settings')['mail']['driver'] == 'smtp') {
        $transport = (new Swift_SmtpTransport(
            $c->get('settings')['mail']['host'],
            $c->get('settings')['mail']['port']
        ))
            ->setEncryption($c->get('settings')['mail']['encryption'])
            ->setAuthMode($c->get('settings')['mail']['auth'])
            ->setUsername($c->get('settings')['mail']['username'])
            ->setPassword($c->get('settings')['mail']['password']);
    } else {
        $transport = new Swift_SendmailTransport("/usr/sbin/sendmail -bs");
    }
    return new Mailer($c->get('view'), new Swift_Mailer($transport));
});
