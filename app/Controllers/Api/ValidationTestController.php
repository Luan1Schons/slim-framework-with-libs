<?php

namespace SlimMonsterKit\Controllers\Api;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use SlimMonsterKit\Controllers\Controller;
use Respect\Validation\Validator as v;
use SlimMonsterKit\Models\User;

class ValidationTestController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $params = $request->getParsedBody();
        $validate = $this->validateParams($params);

        if ($validate->failed()) {
            return $this->withJson($validate->getErrors(), 400);
        }

        return $this->withJson(['result' => 'ok']);
    }

    private function validateParams($params)
    {
        v::with('SlimMonsterKit\\Validation\\Rules');

        $phone = (isset($params['phone'])) ? $params['phone'] : "";
        $phoneNumber = (isset($params['telefone'])) ? $params['telefone'] : "";
        $cell = (isset($params['cell'])) ? $params['cell'] : "";

        return $this->validator->validate($params, [
            'name' => v::notEmpty()->setName('Nome'),
            'user_id' => v::isExists(new User)->setName('User Id'),
            'email' => v::notEmpty()->email()->fieldAvailable(new User, 'email')->setName('E-mail'),
            'cpf_cnpj' => v::notEmpty()->cpfCnpj()->setName('Cpf ou Cnpj'),
            'phone' => v::fieldEmpty([$phoneNumber, $cell])->setName('Telefone1'),
            'phoneNumber' => v::fieldEmpty([$phone, $cell])->setName('Telefone2'),
            'cell' => v::fieldEmpty([$phone, $phoneNumber])->setName('Celular'),
            'password' => v::notEmpty()->setName('Senha'),
        ]);
    }
}
