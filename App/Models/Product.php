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
        $this->db->query("SELECT articulo.idarticulo,articulo.codigo,articulo.nombre,categoria.nombre categoria,articulo.stock,articulo.descripcion,articulo.imagen,articulo.condicion FROM {$this->table} INNER JOIN categoria on articulo.idcategoria = categoria.idcategoria");
        $res = $this->db->get();
        return $res;
    }
    public function crear_producto($data)
    {
        $codigo = $this->clear_inputs_html($data["codigo_producto"]);
        $nombre_producto = $this->clear_inputs_html($data["nombre_producto"]);
        $categoria = $this->clear_inputs_html($data["select_categoria"]);
        $unidad = $this->clear_inputs_html($data["select_unidad"]);
        $stock = $this->clear_inputs_html($data["stock_producto"]);
        $has_image = count($data["FILES"]) > 0 ? true : false;
        $name_image = "default.jpg";
        if ($has_image) {
            $extension = getExtension($data["FILES"]["imagen_producto"]["name"]);
            $name_image = uniqid() . "." . $extension;
            $path = dirname(__DIR__, 2) . '/public/images/products/' . $name_image;
            move_uploaded_file($data["FILES"]["imagen_producto"]["tmp_name"], $path);
        }
        $this->db->query("INSERT INTO {$this->table} (idcategoria, idunidad, codigo, nombre, stock, imagen) VALUES (:categoria,:unidad,:codigo,:nombre,:stock,:img)");
        $this->db->bind(":categoria", $categoria);
        $this->db->bind(":unidad", $unidad);
        $this->db->bind(":codigo", $codigo);
        $this->db->bind(":nombre", $nombre_producto);
        $this->db->bind(":stock", $stock);
        $this->db->bind(":img", $name_image);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
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