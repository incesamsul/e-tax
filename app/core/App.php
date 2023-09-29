<?php

class App
{
    protected $controller = 'Pages';
    protected $method = 'index';
    protected $param = [];

    public function __construct()
    {
        $url = GetUrl::parseURL();
        if (isset($url[0])) {
            $urlController = ucwords($url[0]);
            if (file_exists('app/controllers/' . $urlController . '.php')) {
                $this->controller = $urlController;
                unset($url[0]);
            }
        }


        require_once 'app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }



        if (!empty($url)) {
            $this->param = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->param);
    }
}
