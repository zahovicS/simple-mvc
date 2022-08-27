<?php
class Business extends Controller
{
    public function __construct()
    {
        $this->verifyAuthUser();
        $this->Helper = $this->controller("Helper");
        $this->MBusiness = $this->model("Empresa");
    }
    public function getBusiness()
    {
        dd($this->Helper->getBusiness());
    }
}