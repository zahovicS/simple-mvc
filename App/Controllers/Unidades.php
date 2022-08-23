<?php
class Unidades extends Controller
{
    public function __construct()
    {
        $this->verifyAuthUser();
        parent::__construct();
        $this->MUnidad = $this->model("Unidad");
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
    public function get_all_unidades_for_dropdown()
    {
        $data = $this->MUnidad->unidad_for_dropdown();
        echo json_encode($data);
        return;
    }
}