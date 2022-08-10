<?php
class Usuarios extends Controller
{
    public function __construct()
    {
        $this->Articulo = $this->model("User");
        // echo "controlador de usuarios";
    }
    public function index()
    {
        echo "indice de usuarios";
    }
    public function guardar($id = [])
    {
        echo "guardado";
    }
}
