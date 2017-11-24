<?php
define('INC_ROOT', dirname(__DIR__));

ini_set('display_errors', 'On');

require INC_ROOT.'/vendor/autoload.php';

use Dev\Actions\LookAction;
use Slim\Http\Response;
use Slim\App;
use Slim\Http\Request;
use Slim\Views\Twig;

$app = new App([
    'view' => new Twig(INC_ROOT . "/dev/views/"),
    'template.path' => INC_ROOT . '/dev/views',
    "settings" => [
        "displayErrorDetails" => true
    ]
]);

$app->get('/', function(Request $req, Response $res){
//    $this->flash->addMessage("error", "This is a message");
    return $this->view->render($res, "view.twig");
})->setName("home");

$app->get("/look", function(Request $req, Response $res){
    return $this->view->render($res, "lookup.twig");
})->setName("look");

$app->post("/look", function(Request $req, Response $res){
    $post = $req->getParsedBody();

    //TODO: Traiter les données du formulaires
    $numParam = $post["num"];
    $action = new LookAction();
    $data = $action->returnData($numParam);
    $data = explode("\n", $data);
    //TODO: Rediriger vers la page correspondante
    return $this->view->render($res, "lookup.twig", array(
        'data' =>$data
    ));
})->setName("look.post");