<?php
class Controller
{
    public function model($model)
    {
        require_once dirname(__DIR__, 1) . "/Models/" . $model . ".php";
        return new $model();
    }
    public function view(string $view, $data = [])
    {
        $view = str_replace(".", "/", $view);
        if (!file_exists(dirname(__DIR__, 2) . "/resources/views/" . $view . ".php")) {
            die("View not found");
        }
        require_once dirname(__DIR__, 2) . "/resources/views/layouts/header.php";
        require_once dirname(__DIR__, 2) . "/resources/views/layouts/scripts.php";
        require_once dirname(__DIR__, 2) . "/resources/views/" . $view . ".php";
        require_once dirname(__DIR__, 2) . "/resources/views/layouts/footer.php";
    }
}
