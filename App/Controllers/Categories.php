<?php
class Categories extends Controller
{
    public function __construct()
    {
        $this->verifyAuthUser();
        parent::__construct();
        $this->MCategoria = $this->model("Categoria");
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
        $data = $this->MCategoria->select('*')
            ->where('condicion', '=', 1)->get();
        echo json_encode($data);
        return;
    }
}