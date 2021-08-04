<?php

namespace SlimMonsterKit\Controllers\Web;

use SlimMonsterKit\Controllers\Controller;
use SlimMonsterKit\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        //$users = User::all();
        //return $this->withJson($users);
        //return $this->withJson(['result' => 'ok']);
        $this->log('this is a test of log!');
        $this->log('test error', ['result' => 'error'], 'error');
        return $this->view->render($this->response, 'index.html', []);
    }
}
