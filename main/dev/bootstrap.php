<?php
define('INC_ROOT', dirname(__DIR__));

ini_set('display_errors', 'On');

require INC_ROOT.'/vendor/autoload.php';

use Dev\Actions\LookAction;
use Slim\Http\Response;
use Slim\App;
use Slim\Http\Request;
use Slim\Views\Twig;

ini_set('memory_limit', '1000M');

$app = new App([
    'view' => new Twig(INC_ROOT . "/dev/views/"),
    'template.path' => INC_ROOT . '/dev/views',
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

$app->get('/', function(Request $req, Response $res){
//    $this->flash->addMessage("error", "This is a message");
    return $this->view->render($res, "lookup.twig");
})->setName("home");

$app->post("/", function(Request $req, Response $res){
    $post = $req->getParsedBody();
    //TODO: Traiter les données du formulaires
    $numParam = $post["num"];
    $action = new LookAction();
    $data = $action->returnData($numParam);
    $line = "";
    $ret = array();
    foreach ($data as $line) {
        array_push($ret, explode(" ",$line, 3));
    }
    //TODO: Rediriger vers la page correspondante
    return $this->view->render($res, "lookup.twig", array(
        'data' =>$ret
    ));
})->setName("look.post");
