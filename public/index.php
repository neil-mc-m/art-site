<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 01/06/2016
 * Time: 23:35
 */
require '../src/bootstrap.php';

$app->get('/', 'Art\\Controllers\\MainController::indexAction');
$app->get('/home', 'Art\\Controllers\\MainController::indexAction');
$app->get('/art', 'Art\\Controllers\\MainController::artAction');
$app->get('/exhibitions', 'Art\\Controllers\\MainController::exhibitionAction');
$app->get('/exhibitions-solo', 'Art\\Controllers\\MainController::soloExhibitionAction');
$app->get('/exhibitions-group', 'Art\\Controllers\\MainController::groupExhibitionAction');
$app->match('/contact', 'Art\\Controllers\\MainController::contactFormAction');

$app->run();