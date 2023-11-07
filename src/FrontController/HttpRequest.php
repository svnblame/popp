<?php declare(strict_types=1);

namespace POPP\FrontController;

class HttpRequest extends Request
{

    public function init()
    {
        // we're conveniently ignoring POST/GET/others distinctions
        // don't do this in the real world!
        $this->properties = $_REQUEST;
        $pathInfo = $_SERVER['REQUEST_URI'];
        $this->path = (empty($pathInfo)) ? '/' : $pathInfo;
    }
}
