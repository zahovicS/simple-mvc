<?php
class Product extends Model
{
    public function __construct()
    {
        $this->table = "articulo";
        parent::__construct();
    }
    public function getAllProducts()
    {
        $res = [];
        $this->db->query("SELECT articulo.idarticulo,articulo.codigo,articulo.nombre,categoria.nombre categoria,articulo.stock,articulo.descripcion,articulo.imagen,articulo.condicion FROM articulo INNER JOIN categoria on articulo.idcategoria = categoria.idcategoria");
        $res = $this->db->get();
        return $res;
    }
    public function desactivar_producto($id)
    {
        $this->db->query("UPDATE {$this->table} SET condicion = 0 WHERE idarticulo = :idArticulo");
        $this->db->bind(":idArticulo", $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function activar_producto($id)
    {
        $this->db->query("UPDATE {$this->table} SET condicion = 1 WHERE idarticulo = :idArticulo");
        $this->db->bind(":idArticulo", $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}