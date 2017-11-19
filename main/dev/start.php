<?php
use Slim\App;
//defini la root de base qui et celle du repertoire courrant
define('INC_ROOT', dirname(__DIR__));

//dis a slim de display les erreurs
ini_set('display_errors', 'On');

//require toutes les dependances en occurance twig view et slim
require INC_ROOT.'/vendor/autoload.php';

//Slim utilise des namespace pour éviter les conflits
$app = new App();

$app->get('/', function($request, $response, $args) {
    return $response->withStatus(200)->write('Hello World');
});

$app->get('/look', function($request, $response,$args) {
    return $response->withStatus(200)->write('it\'s the look page here');
});