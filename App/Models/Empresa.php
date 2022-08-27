<?php
class Empresa extends Model
{
    public function __construct()
    {
        $this->table = "business";
        parent::__construct();
    }
}