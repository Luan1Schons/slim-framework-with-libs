<?php

namespace SlimMonsterKit\Mail;

use Exception;

class Mailer
{
    protected $view;
    protected $mailer;

    public function __construct($view, $mailer)
    {
        $this->view = $view;
        $this->mailer = $mailer;
    }

    public function send($template, $data, $callback)
    {
        try {
            $message = new Message();
            $message->body($this->view->fetch($template, $data));
            $message->type('text/html');
            call_user_func($callback, $message);
            $this->mailer->send($message);
        } catch (Exception $e) {
            var_dump($e);
            die();
        }
    }
}
