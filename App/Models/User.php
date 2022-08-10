<?php
class User extends Model
{
    public function __construct()
    {
        $this->table = "usuario";
        parent::__construct();
    }
    public function addUser(array $data)
    {
        $this->db->query("INSERT INTO {$this->table} (nombre,tipo_documento) VALUES (:nombre,:documento)");
        $this->db->bind(":nombre", $data["nombre"]);
        $this->db->bind(":documento", $data["documento"]);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
