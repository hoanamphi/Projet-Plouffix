<?php
define('INC_ROOT', dirname(__DIR__));

ini_set('display_errors', 'On');

require INC_ROOT.'/vendor/autoload.php';

ini_set('memory_limit', '4095M');

//use Dev\Helpers\TwigExtensions\FlashExtension;
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

//$container["flash"] = function(){
//    return new \Slim\Flash\Messages();
//};


$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(INC_ROOT . '/views');
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
//    $view->addExtension(new FlashExtension(
//        $container->flash
//    ));

    return $view;
};



$app->get('/', function(Request $req, Response $res){
//    $this->flash->addMessage("error", "This is a message");
    return $this->view->render($res, "lookup.twig");
})->setName("home");

$app->post("/", function(Request $req, Response $res){
    $post = $req->getParsedBody();
    $numParam = $post["num"];
    $action = new LookAction();
    $data = $action->returnData($numParam);
    $ret = array();
    $line = "";
    foreach ($data as $line) {
        array_push($ret, explode(" ",$line, 3));
    }

    return $this->view->render($res, "lookup.twig", array(
        'data' =>$ret
    ));
})->setName("look.post");

$app->get('/Look/{number}', function ($request, $response, $args) {
    $action = new LookAction();
    return $response->$action->withJson( $action->returnData($args["number"]) );
});