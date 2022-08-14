<?php

use Dompdf\Dompdf;

class Reports extends Controller
{
    public function __construct()
    {
        $this->User = $this->model("User");
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
    public function example($name)
    {
        $dompdf = new Dompdf();
        $user = $this->User->all();
        $html = $this->view('reports.pdf.reporte_ventas', ["name" => "Registro de usuarios", 'user' => $user], false, true);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'protrait');
        $dompdf->render();
        $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
        exit(0);
    }
}