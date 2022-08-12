<?php
class Products extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        if (!empty($_SESSION["id_usuario"])) {
            $data = [
                "title" => "Productos - MVC"
            ];
            return $this->view("almacen.products", $data);
        }
        $this->redirect(BASE_URL . "/");
    }
}