<?php
class Dashboard extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        if (!empty($_SESSION["id_usuario"])) {
            $data = [
                "title" => "Inicio - Dashboard"
            ];
            return $this->view("dashboard.index", $data);
        }
        $this->redirect(BASE_URL . "/");
    }
}