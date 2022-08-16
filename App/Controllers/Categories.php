<?php
class Categories extends Controller
{
    public function __construct()
    {
        $this->MCategoria = $this->model("Categoria");
        parent::__construct();
    }
    public function index()
    {
        if (!empty($_SESSION["id_usuario"])) {
            $data = [
                "title" => "Categoria - MVC"
            ];
            // return $this->view("almacen.products", $data);
        }
        // $this->redirect(BASE_URL . "/");
    }
    public function get_all_categories_for_dropdown()
    {
        $data = $this->MCategoria->categories_for_dropdown();
        echo json_encode($data);
        return;
    }
}