<?php
class Web extends Controller
{
    public function __construct()
    {
        $this->MProduct = $this->model("Product");
    }
    public function request($req)
    {
        $data = $this->MProduct->select("categoria.nombre categoria", "articulo.*")
            ->join("categoria", "articulo.idcategoria", "=", "categoria.idcategoria")
            ->where('articulo.condicion', "=", 1)
            ->and('articulo.stock', ">", 5)
            ->get();
        dd($data);
    }
    public function _404()
    {
        return $this->view("errors.404", [], false);
    }
}