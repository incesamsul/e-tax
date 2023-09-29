<?php

class Controller
{
    public function view($view, $data = [])
    {
        require_once 'app/views/' . $view . '.php';
    }



    public function model($model)
    {
        require_once 'app/models/' . $model . '.php';
        return new $model;
    }

    public function script($script)
    {
        $path = 'app/script/' . $script . '.js';
        if (file_exists($path)) {
            $script = '<script src="' . BASEURL . '/' . $path . '"></script>';
            return $script;
        }
    }
}
