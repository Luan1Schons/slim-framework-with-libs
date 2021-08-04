<?php

namespace SlimMonsterKit\Controllers\Api;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use SlimMonsterKit\Controllers\Controller;

class UploadTestController extends Controller
{
    public function upload(Request $request, Response $response)
    {
        $params = $request->getParsedBody();
        $uploadFiles = $request->getUploadedFiles();

        $this->fs->write('/test/' . $params['filename'], $uploadFiles['file']->getStream()->getContents());

        $response->getBody()
            ->write(json_encode($params));

        return $response;
    }
}
