<?php

namespace SlimMonsterKit\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CsrfFieldsMiddleware extends Middleware
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $nameKey = $this->csrf->getTokenNameKey();
        $valueKey = $this->csrf->getTokenValueKey();
        $name = $this->csrf->getTokenName();
        $value = $this->csrf->getTokenValue();

        $fields  = "<input type=\"hidden\" name=\"{$nameKey}\" value=\"{$name}\">";
        $fields .= "<input type=\"hidden\" name=\"{$valueKey}\" value=\"{$value}\">";

        $this->view->getEnvironment()->addGlobal('csrf', $fields);

        return $handler->handle($request);
    }
}
