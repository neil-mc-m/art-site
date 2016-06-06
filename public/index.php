<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 01/06/2016
 * Time: 23:35
 */
require __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
// turn on for developing
$app['debug'] = true;
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../templates'
));
$app->register(new Silex\Provider\AssetServiceProvider(), array(
    'assets.named_packages' => array(
        'css' => array('version' => 'css2', 'base_path' => '/css')),
    'assets.named_packages' => array(
        'js' => array('version' => 'uikitJS', 'base_path' => '/js')
    )
));
$app->get('/', 'Art\\Controllers\\MainController::indexAction');
$app->get('/art', 'Art\\Controllers\\MainController::artAction');

$app->run();