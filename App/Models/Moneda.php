<?php
class Moneda extends Model
{
    public function __construct()
    {
        $this->table = "moneda";
        parent::__construct();
    }
}