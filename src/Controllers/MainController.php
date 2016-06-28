<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 02/06/2016
 * Time: 00:35
 */
namespace Art\Controllers;
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
        $stmt = $app['db']->prepare('SELECT * FROM image');

        $stmt->execute();
        $img = $stmt->fetchAll(PDO::FETCH_CLASS, '\\Art\\Image');
        
        $templateName = 'art';
        $args_array = array(
            'images' => $img
        );
        
        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }
    
    public function exhibitionAction(Request $request, Application $app)
    {
        $stmt = $app['db']->prepare('SELECT * FROM exhibition');
        $stmt->execute();
        $img = $stmt->fetchAll(PDO::FETCH_OBJ);
        $templateName = 'exhibition';
        $args_array = array(
            'images' => $img
        );
        
        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }
}