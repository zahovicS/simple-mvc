<?php
session_start();
class Controller
{
    public function __construct()
    {
    }
    public function model($model)
    {
        require_once dirname(__DIR__, 1) . "/Models/" . $model . ".php";
        return new $model();
    }
    public function view(string $view, $data = [], $render = true)
    {
        $view = str_replace(".", "/", $view);
        if (!file_exists(dirname(__DIR__, 2) . "/resources/views/" . $view . ".php")) {
            die("View not found");
        }
        if ($render) {
            require_once dirname(__DIR__, 2) . "/resources/views/layouts/header.php";
            require_once dirname(__DIR__, 2) . "/resources/views/layouts/scripts.php";
            require_once dirname(__DIR__, 2) . "/resources/views/" . $view . ".php";
            require_once dirname(__DIR__, 2) . "/resources/views/layouts/footer.php";
        } else {
            require_once dirname(__DIR__, 2) . "/resources/views/" . $view . ".php";
        }
    }
    function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }
}