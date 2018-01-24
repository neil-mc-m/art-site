<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 02/06/2016
 * Time: 00:35
 */
namespace Art\Controllers;

use Art\ContactType;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MainController
 * @package Art\Controllers
 */
class MainController
{
    /**
     * 
     * @param Application $app
     * @return mixed
     */
    public function indexAction(Application $app)
    {
        $templateName = 'home';
        $args_array = array();

        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }

    /**
     * 
     * @param Application $app
     * @return mixed
     */
    public function artAction(Application $app)
    {
        $img = $app['dbrepo']->getAllImages();
        $templateName = 'art';
        $args_array = array(
            'images' => $img
        );
        $response = new Response($app['twig']->render($templateName.'.html.twig', $args_array));
//        $response->setSharedMaxAge(3600);
        
        return $response;
    }

    /**
     * @param Application $app
     * @return mixed
     */
    public function collageAction(Application $app)
    {
        $img = $app['dbrepo']->getAllCollage();
        $templateName = 'collage';
        $args_array = array(
            'images' => $img
        );
        
        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }
    public function oilAction(Application $app)
    {
        $img = $app['dbrepo']->getAllOil();
        $templateName = 'oil';
        $args_array = array(
            'images' => $img
        );

        return $app['twig']->render($templateName.'.html.twig', $args_array); 
    }
    /**
     * 
     * @param Application $app
     * @return mixed
     */
    public function exhibitionAction(Application $app)
    {
        $exhib = $app['dbrepo']->getAllExhibitions();
        $templateName = 'exhibition';
        $args_array = array(
            'exhibitions' => $exhib
        );
        
        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }

    /**
     * 
     * @param Application $app
     * @return mixed
     */
    public function soloExhibitionAction(Application $app)
    {
        $solo = $app['dbrepo']->getAllSolo();
        $templateName = 'solo';
        $args_array = array(
            'solo' => $solo
        );
        
        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }

    /**
     * 
     * @param Application $app
     * @return mixed
     */
    public function groupExhibitionAction(Application $app)
    {
        $group  = $app['dbrepo']->getAllGroup();
        $templateName = 'group';
        $args_array = array(
            'group' => $group
        );
        
        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }
    
    public function hermitExhibitionAction(Application $app)
    {
        $hermit = $app['dbrepo']->getAllHermit();
        $templateName = 'hermit';
        $args_array = array(
            'hermit' => $hermit
        );
        
        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }
    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function contactFormAction(Request $request, Application $app)
    {
        $sent = false;
        $data = array(
            'name' => '',
            'email' => '',
            'message' => ''
        );
        $form = $app['form.factory']
            ->createBuilder(ContactType::class, $data)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $message = \Swift_Message::newInstance()
                ->setSubject('Dave Gearty Contact form')
                ->setFrom(array($data['email'] => $data['name']))
                ->setTo(array('dvg013@gmail.com'))
                ->setReplyTo(array($data['email'] => $data['name']))
                ->setBody($data['message']);

            $app['mailer']->send($message);

            $sent = true;
        }
        $templateName = 'contact';
        $args_array = array(
            'form' => $form->createView(),
            'sent' => $sent
        );
        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }
}
