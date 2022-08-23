<?php
class Unidad extends Model
{
    public function __construct()
    {
        $this->table = "unidad";
        parent::__construct();
    }
    public function unidad_for_dropdown()
    {
        $res = [];
        $this->db->query("SELECT * FROM {$this->table} WHERE condicion = 1");
        $res = $this->db->get();
        return $res;
    }
}