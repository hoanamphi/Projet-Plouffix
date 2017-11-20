<?php
//defini la root de base qui et celle du repertoire courrant
define('INC_ROOT', dirname(__DIR__));

//dis a slim de display les erreurs
ini_set('display_errors', 'On');

//require toutes les dependances en occurance twig views et slim
require INC_ROOT.'/vendor/autoload.php';

use Slim\Http\Response;
use Slim\App;
use Slim\Http\Request;
use Slim\Views\Twig;

//Slim utilise des namespace pour éviter les conflits
$app = new App([
    'view' => new Twig(INC_ROOT . "/dev/views/"),
    'template.path' => INC_ROOT . '/dev/views',
    "settings" => [
        "displayErrorDetails" => true
    ]
]);

$app->get('/', function(Request $rq, Response $res, array $args) use ($app){
    echo 'this is a test';
    return $this->view->render($res, 'view.php');
});

$app->get("/{id}", function(Request $rq, Response $res, array $args){
    return $this->view->render($res, "lookup.twig", [
        "id" => $args["id"]
    ]);
});