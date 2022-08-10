<?php
class Model
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = new Base;
    }
    public function all()
    {
        $this->db->query("SELECT * FROM {$this->table}");
        return $this->db->get();
    }
    public function first()
    {
        $this->db->query("SELECT * FROM {$this->table} LIMIT 1");
        return $this->db->first();
    }
    public function find($id, $ownerKeyID = "id")
    {
        $this->db->query("SELECT * FROM {$this->table} where {$ownerKeyID} = {$id} LIMIT 1");
        return $this->db->first();
    }
    public function delete($id, $ownerKeyID = "id")
    {
        $this->db->query("DELETE FROM {$this->table} where {$ownerKeyID} = {$id}");
        return $this->db->execute();
    }
}
