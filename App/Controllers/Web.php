<?php
class Web extends Controller
{
    public function __construct()
    {
        $this->model_usuario = $this->model("User");
    }
    public function index()
    {
        $usuarios = $this->model_usuario->find(2, "idusuario");
        $data = [
            "title" => "Inicio - Dashboard",
            "usuarios" => $usuarios
        ];
        $this->view("dashboard.index", $data);
    }
    public function request($req){
        dd($req);
    }
}
