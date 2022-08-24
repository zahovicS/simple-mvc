<?php
class Product extends Model
{
    public function __construct()
    {
        $this->table = "articulo";
        parent::__construct();
    }
    public function getAllProducts(): array
    {
        $res = [];
        $this->db->query("SELECT articulo.idarticulo,articulo.codigo,articulo.nombre,categoria.nombre categoria,articulo.stock,articulo.descripcion,articulo.imagen,articulo.condicion FROM {$this->table} INNER JOIN categoria on articulo.idcategoria = categoria.idcategoria");
        $res = $this->db->get();
        return $res;
    }
    public function crear_producto(object $data): bool
    {
        $codigo = $this->clear_inputs_html($data->codigo_producto);
        $nombre_producto = $this->clear_inputs_html($data->nombre_producto);
        $categoria = $this->clear_inputs_html($data->select_categoria);
        $unidad = $this->clear_inputs_html($data->select_unidad);
        $stock = $this->clear_inputs_html($data->stock_producto);
        $has_image = count($data->FILES) > 0 ? true : false;
        $name_image = "default.jpg";
        if ($has_image) {
            $extension = getExtension($data->FILES["imagen_producto->name"]);
            $name_image = uniqid() . "." . $extension;
            $path = dirname(__DIR__, 2) . '/public/images/products/' . $name_image;
            move_uploaded_file($data->FILES["imagen_producto"]["tmp_name"], $path);
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
    public function editar_producto(object $data): bool
    {
        $idArticulo = $this->clear_inputs_html(base64_decode($data->id_producto_edit));
        $codigo = $this->clear_inputs_html($data->codigo_producto_edit);
        $nombre_producto = $this->clear_inputs_html($data->nombre_producto_edit);
        $categoria = $this->clear_inputs_html($data->select_categoria_edit);
        $unidad = $this->clear_inputs_html($data->select_unidad_edit);
        $stock = $this->clear_inputs_html($data->stock_producto_edit);
        $has_image = count($data->FILES) > 0 ? true : false;
        $og_product = $this->getProductById($idArticulo);
        $name_image = $og_product->imagen;
        if ($has_image) {
            unlink(dirname(__DIR__, 2) . '/public/images/products/' . $name_image);
            $extension = getExtension($data->FILES["imagen_producto_edit"]["name"]);
            $name_image = uniqid() . "." . $extension;
            $path = dirname(__DIR__, 2) . '/public/images/products/' . $name_image;
            move_uploaded_file($data->FILES["imagen_producto_edit"]["tmp_name"], $path);
        }
        $this->db->query("UPDATE {$this->table} SET idcategoria = :categoria, idunidad = :unidad, codigo=:codigo, nombre=:nombre, stock=:stock,imagen=:img WHERE idarticulo=:idArticulo");
        $this->db->bind(":idArticulo", $idArticulo);
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
    public function desactivar_producto(string $id): bool
    {
        $this->db->query("UPDATE {$this->table} SET condicion = 0 WHERE idarticulo = :idArticulo");
        $this->db->bind(":idArticulo", $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function activar_producto(string $id): bool
    {
        $this->db->query("UPDATE {$this->table} SET condicion = 1 WHERE idarticulo = :idArticulo");
        $this->db->bind(":idArticulo", $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getProductById(string $id): object
    {
        $res = [];
        $this->db->query("SELECT articulo.* FROM {$this->table} WHERE articulo.idarticulo = :idArticulo");
        $this->db->bind(":idArticulo", $id);
        if ($this->db->execute()) {
            $res = $this->db->first();
        }
        return $res;
    }
}