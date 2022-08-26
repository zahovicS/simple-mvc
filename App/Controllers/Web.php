<?php
class Web extends Controller
{
    public function __construct()
    {
        $this->MProduct = $this->model("Product");
    }
    public function index()
    {
        // $data = [
        //     "title" => "Inicio - Dashboard",
        //     "usuarios" => $usuarios
        // ];
        // $this->view("dashboard.index", $data);
    }
    public function request($req)
    {
        $data = $this->MProduct->select("SELECT categoria.nombre categoria, articulo.*")
            ->join("categoria", "articulo.idcategoria", "=", "categoria.idcategoria")
            ->where('articulo.condicion', "=", 1)
            ->and('articulo.stock', ">", 5)
            ->first();
        dd($data);
    }
}