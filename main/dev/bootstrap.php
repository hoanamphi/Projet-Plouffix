<?php
define('INC_ROOT', dirname(__DIR__));

ini_set('display_errors', 'On');

require INC_ROOT.'/vendor/autoload.php';

ini_set('memory_limit', '4095M');

use Dev\Action\LookAction;
use Slim\Http\Response;
use Slim\App;
use Slim\Http\Request;
use Slim\Views\Twig;

$app = new App([
    'view' => new Twig(INC_ROOT . "/Dev/views/"),
    'template.path' => INC_ROOT . '/Dev/views',
    "settings" => [
        "displayErrorDetails" => true
    ]
]);

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(INC_ROOT . '/views');
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    return $view;
};

//Affiche la page
$app->get('/', function(Request $req, Response $res){
    return $this->view->render($res, "lookup.twig");
})->setName("home");

//Récupère les requêtes en POST
$app->post("/", function(Request $req, Response $res){
    $post = $req->getParsedBody();
    $numParam = $post["num"];
    $action = new LookAction();
    $data = $action->returnData($numParam);
    $ret = array();
    foreach ($data as $line) {
        array_push($ret, explode(" ",$line, 3));
    }

    return $this->view->render($res, "lookup.twig", array(
        'data' =>$ret
    ));
})->setName("look.post");

//Récupère les requêtes en GET
$app->get('/Look/{number}', function ($request, $response, $args) {
    try {
        $action = new LookAction();
    } catch(Exception $e) {
        echo "Exception : "+$e->getMessage();
        return $response->withJson($e);
    }
    $num = $args['number'];
    $data = $action->returnData($num);
    $tmp = array();
    foreach ($data as $line) {
        array_push($tmp, explode(" ",$line, 3));
    }
    return $response->withJson($tmp);
})->setName("look.get");