<?php
class Categoria extends Model
{
    public function __construct()
    {
        $this->table = "categoria";
        parent::__construct();
    }
}