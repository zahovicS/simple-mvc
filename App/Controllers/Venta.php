<?php
class Venta extends Controller
{
    public function __construct()
    {
        $this->verifyAuthUser();
        parent::__construct();
        // $this->MUnidad = $this->model("Unidad");
    }
    public function index()
    {
        return $this->view("ventas.venta", ["title" => "Ventas"]);
    }
}