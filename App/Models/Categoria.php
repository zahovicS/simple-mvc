<?php
class Categoria extends Model
{
    public function __construct()
    {
        $this->table = "categoria";
        parent::__construct();
    }
    public function categories_for_dropdown()
    {
        $res = [];
        $this->db->query("SELECT categoria.* FROM {$this->table} WHERE condicion = 1");
        $res = $this->db->get();
        return $res;
    }
}