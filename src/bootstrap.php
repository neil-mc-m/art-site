<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 01/07/2016
 * Time: 23:46
 */
require __DIR__ . '/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
$app = new Silex\Application();
// turn on for developing
//$app['debug'] = true;
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../templates'
));
$app->register(new Silex\Provider\AssetServiceProvider(), array(
    'assets.named_packages' => array(
        'js'     => array('version' => 'uikitJS', 'base_path' => '/js'),
        'css'    => array('version' => '2', 'base_path' => '/build'),
        'images' => array('version' => 'optimised', 'base_path' => '/build')
    )
));
$config = parse_ini_file('../config/config.ini', true);
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => $config['database']
));
$app->register(new \Art\DbRepoServiceProvider());
$app->register(new Silex\Provider\FormServiceProvider());
$app->extend('form.types', function ($types) {
    $types[] = new \Art\ContactType();

    return $types;
});
$app->extend('form.types', function ($types) {
    $types[] = new \Art\UpdateType();

    return $types;
});

$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'admin' => array(
            'pattern' => '^/admin',
            'form' => array('login_path' => '/login', 'check_path' => '/admin/login_check'),
            'logout' => array('logout_path' => '/admin/logout', 'invalidate_session' => true),
            'users' => array($config['login']['user'] => array(
                $config['login']['role'],$config['login']['password']
            )),
            ),
        ),
    'security.encoder.bcrypt.cost' => 4
    )
);
$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.domains' => array(),
));
$app->register(new Silex\Provider\SwiftmailerServiceProvider());
$app['swiftmailer.options'] = $config['email'];
$app->register(new Silex\Provider\HttpCacheServiceProvider(), array(
    'http_cache.cache_dir' => __DIR__.'/../cache',
    'http_cache.esi'       => null
));
Request::setTrustedProxies(array('127.0.0.1'));
return $app;
