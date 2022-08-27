<?php

use Luecano\NumeroALetras\NumeroALetras;

class Helper extends Controller
{
    public function __construct()
    {
        $this->verifyAuthUser();
        parent::__construct();
        $this->MBusiness = $this->model("Empresa");
        $this->MMoneda = $this->model("Moneda");
        $this->formatter = new NumeroALetras();
    }
    public function getBusiness(): object
    {
        $data = $this->MBusiness->select('*')->where('idbusiness', '=', $_SESSION["id_business"])->first();
        return $data;
    }
    public function getMoneda(): object
    {
        $business = $this->getBusiness();
        $data = $this->MMoneda->select('*')->where('idmoneda', '=', $business->idmoneda)->first();
        return $data;
    }
    public function formatPrice($price): string
    {
        $moneda = $this->getMoneda();
        return $moneda->simbolo . "" . number_format($price, 2);
    }
    public function NumeroALetras($price, string $divisa): string
    {
        return $this->formatter->toInvoice($price, 3, $divisa);
    }
}