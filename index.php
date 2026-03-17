<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/database.php';

use App\Models\CatModel;
use App\Controllers\CatController;

$db = getConnection();
$catModel = new CatModel($db);
$catController = new CatController($catModel);

$router = new \Bramus\Router\Router();

// Group routes under /cats
$router->mount('/cats', function() use ($router, $catController) {
    $router->get('/', fn() => $catController->index());
    $router->get('/(\d+)', fn($id) => $catController->show($id));
    $router->post('/', fn() => $catController->store());
    $router->put('/(\d+)', fn($id) => $catController->update($id));
    $router->delete('/(\d+)', fn($id) => $catController->destroy($id));
});

$router->run();