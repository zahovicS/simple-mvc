<?php
//Libs
require_once dirname(__DIR__) . "/App/Configs/Configs.php";
require_once dirname(__DIR__) . "/App/Libs/Base.php";
require_once dirname(__DIR__) . "/App/Libs/Controller.php";
require_once dirname(__DIR__) . "/App/Libs/Model.php";
require_once dirname(__DIR__) . "/App/Libs/Router.php";
require_once dirname(__DIR__) . "/App/Libs/Core.php";
// require_once dirname(__DIR__) . "/App/Libs/Request.php";
//Autload
spl_autoload_register(function ($clase) {
    require_once dirname(__DIR__) . "/App/Controllers/" . $clase . ".php";
    // require_once dirname(__DIR__) . "/App/Libs/" . $clase . ".php";
});
//other
require '../vendor/autoload.php';
$router = new Router();
#LOGIN
$router->get('/', Login::class . "::index");
$router->post('/Login', Login::class . "::loger");
$router->post('/Login/logout', Login::class . "::logout");
#END LOGIN
#DASHBOARD
$router->get('/dashboard', Dashboard::class . "::index");
#END DASHBOARD
#PRODUCTS
$router->get('/products', Products::class . "::index");
$router->get('/products/cargar_tabla', Products::class . "::tableProducts");
$router->post('/products/crear', Products::class . "::crear");
$router->post('/products/editar', Products::class . "::editar");
$router->get('/products/getProductById', Products::class . "::getProductById");
$router->get('/products/activar_producto', Products::class . "::activar_producto");
$router->get('/products/desactivar_producto', Products::class . "::desactivar_producto");
#END PRODUCTS
#CATEGORIES
$router->get('/categories/categories_for_dropdown', Categories::class . "::get_all_categories_for_dropdown");
#END CATEGORIES
#UNIDADES
$router->get('/unidades/unidades_for_dropdown', Unidades::class . "::get_all_unidades_for_dropdown");
#END UNIDADES
#TESTING
$router->post('/post', function (array $params = []) {
    dd($params);
});
$router->get('/test', Web::class . "::request");
#END TESTING
$router->addNotFoundHandler(function () {
    echo 'NOT FOUND';
});
$router->run();