<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 02/06/2016
 * Time: 00:35
 */
namespace Art\Controllers;
use Art\dbrepo;
use \PDO;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class MainController
{
    public function indexAction(Request $request, Application $app)
    {
        $templateName = 'home';
        $args_array = array();

        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }
    
    public function artAction(Request $request, Application $app)
    {
        $db = new dbrepo($app['db']);
        $img = $db->getAllImages();
        
        $templateName = 'art';
        $args_array = array(
            'images' => $img
        );
        
        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }
    
    public function exhibitionAction(Request $request, Application $app)
    {
        $db = new dbrepo($app['db']);
        $exhib = $db->getAllExhibitions();
        $templateName = 'exhibition';
        $args_array = array(
            'exhibitions' => $exhib
        );
        
        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }
    public function soloExhibitionAction(Request $request, Application $app)
    {
        $db = new dbrepo($app['db']);
        $solo = $db->getAllSolo();
        $templateName = 'solo';
        $args_array = array(
            'solo' => $solo
        );
        
        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }
}