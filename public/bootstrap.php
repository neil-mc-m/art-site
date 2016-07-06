<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 01/07/2016
 * Time: 23:46
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
        'js'     => array('version' => 'uikitJS', 'base_path' => '/js'),
        'css'    => array('version' => 'css', 'base_path' => '/css'),
        'images' => array('version' => 'original', 'base_path' => '/images')
    )
));
$config = parse_ini_file('../config/config.ini');
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => $config
));

$app->register(new Silex\Provider\FormServiceProvider());

$app->extend('form.types', function ($types) use ($app) {
    $types[] = new \Art\ContactType();

    return $types;
});
$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.domains' => array(),
));
$app->register(new Silex\Provider\SwiftmailerServiceProvider());

return $app;