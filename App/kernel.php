<?php
//Libs
require_once dirname(__DIR__) . "/App/Configs/Configs.php";
require_once dirname(__DIR__) . "/App/Libs/Base.php";
require_once dirname(__DIR__) . "/App/Libs/Controller.php";
require_once dirname(__DIR__) . "/App/Libs/Model.php";
// require_once dirname(__DIR__) . "/App/Libs/Core.php";
require_once dirname(__DIR__) . "/App/Libs/Router.php";
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
$router->get('/products/activar_producto', Products::class . "::activar_producto");
$router->get('/products/desactivar_producto', Products::class . "::desactivar_producto");
#END PRODUCTS
#CATEGORIES
// $router->get('/products', Products::class . "::index");
$router->get('/categories/categories_for_dropdown', Categories::class . "::get_all_categories_for_dropdown");
#END CATEGORIES
#TESTING
$router->post('/post', function ($params) {
    var_dump($params);
});
$router->get('/test', function (array $params = []) {
    var_dump($params);
});
#END TESTING
$router->addNotFoundHandler(function () {
    echo 'NOT FOUND';
});
$router->run();