<?php
class Products extends Controller
{
    public function __construct()
    {
        $this->verifyAuthUser();
        parent::__construct();
        $this->MProducts = $this->model("Product");
        $this->Helper = $this->controller("Helper");
    }
    public function index()
    {
        if (!empty($_SESSION["id_usuario"])) {
            $data = [
                "title" => "Productos - MVC"
            ];
            return $this->view("almacen.products", $data);
        }
        $this->redirect(BASE_URL . "/");
    }
    public function tableProducts()
    {
        $result["data"] = [];
        $products = $this->MProducts->getAllProducts();
        foreach ($products as $key => $value) {
            $idProducto = base64_encode($value->idarticulo);
            if ($value->condicion == "1") {
                $actions = '<div class="buttons are-small is-centered">
                                <div class="tooltip">
                                    <span class="tooltiptext">Editar</span>
                                    <button class="button is-small is-warning pt-0 pb-0 m-0 mb-2 mr-1 ml-1 editarProduct jb-modal" data-id="' . $idProducto . '" data-target="#editar-producto"  type="button">
                                        <span class="icon"><i class="fa-solid fa-pen fa-lg"></i></span>
                                    </button>
                                </div>            
                                <div class="tooltip">
                                    <span class="tooltiptext">Desactivar</span>
                                    <button class="button is-small is-danger pt-0 pb-0 m-0 mb-2 mr-1 ml-1 desactivateProduct" data-id="' . $idProducto . '" type="button">
                                        <span class="icon"><i class="fa-regular fa-trash-can"></i></span>
                                    </button>
                                </div>            
                        </div>';
            } else {
                $actions = '<div class="buttons are-small is-centered">
                                <div class="tooltip">
                                    <span class="tooltiptext">Activar</span>
                                    <button class="button is-small is-primary pt-0 pb-0 m-0 mb-2 mr-1 ml-1 activateProduct" data-id="' . $idProducto . '"  type="button">
                                        <span class="icon"><i class="fa-solid fa-check"></i></span>
                                    </button>
                                </div>            
                        </div>';
            }
            $stock = floatval($value->stock) > 5 ? '<div class="has-text-centered"><span class="tag is-primary is-light">' . $value->stock . '</span></div>' : '<div class="has-text-centered"><span class="tag is-danger is-light">' . $value->stock . '</span></div>';
            $result["data"][$key] = [
                $key + 1,
                $value->codigo,
                $value->nombre,
                $value->categoria,
                $stock,
                $this->Helper->formatPrice($value->price_out),
                $value->condicion == "1" ? '<div class="has-text-centered"><span class="tag is-primary is-light">Activado</span></div>' : '<div class="has-text-centered"><span class="tag is-danger is-light">Desactivado</span></div>',
                $actions
            ];
        }
        echo json_encode($result);
        return;
    }
    public function desactivar_producto(object $request)
    {
        $id = base64_decode($request->id);
        $response = $this->MProducts->desactivar_producto($id);
        if (!$response) {
            echo json_encode($this->message(false, "Hubo un error al actualizar."));
            return;
        }
        echo json_encode($this->message(true, "Datos actualizados correctamente."));
        return;
    }
    public function activar_producto(object $request)
    {
        $id = base64_decode($request->id);
        $response = $this->MProducts->activar_producto($id);
        if (!$response) {
            echo json_encode($this->message(false, "Hubo un error al actualizar."));
            return;
        }
        echo json_encode($this->message(true, "Datos actualizados correctamente."));
        return;
    }
    public function crear(object $request)
    {
        if ($request->codigo_producto != "") {
            $has_image = count($request->FILES) > 0 ? true : false;
            if ($has_image) {
                $image_response = $this->verifyImage($request->FILES["imagen_producto"]);
                if (!$image_response["status"]) {
                    echo json_encode($this->message($image_response["status"], $image_response["msg"]));
                    return;
                }
            }
            $response = $this->MProducts->crear_producto($request);
            if (!$response) {
                echo json_encode($this->message(false, "Hubo un error al crear."));
                return;
            }
            echo json_encode($this->message(true, "Datos agregados correctamente."));
            return;
        }
        echo json_encode($this->message(false, "Hubo un error en la creación."));
        return;
    }
    public function editar(object $request)
    {
        // echo json_encode($request);
        if ($request->id_producto_edit != "") {
            $has_image = count($request->FILES) > 0 ? true : false;
            if ($has_image) {
                $image_response = $this->verifyImage($request->FILES["imagen_producto_edit"]);
                if (!$image_response["status"]) {
                    echo json_encode($this->message($image_response["status"], $image_response["msg"]));
                    return;
                }
            }
            $response = $this->MProducts->editar_producto($request);
            if (!$response) {
                echo json_encode($this->message(false, "Hubo un error al actualizar."));
                return;
            }
            echo json_encode($this->message(true, "Datos actualizados correctamente."));
            return;
        }
        echo json_encode($this->message(false, "Hubo un error en la actualización."));
        return;
    }
    public function getProductById(object $request)
    {
        $id = base64_decode($request->id);
        $data = $this->MProducts->getProductById($id);
        echo json_encode($data);
        return;
    }
}