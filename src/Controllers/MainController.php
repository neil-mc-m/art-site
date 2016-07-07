<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 02/06/2016
 * Time: 00:35
 */
namespace Art\Controllers;

use Art\Contact;
use Art\ContactType;
use Art\dbrepo;
use \PDO;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\Type;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class MainController
 * @package Art\Controllers
 */
class MainController
{
    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function indexAction(Request $request, Application $app)
    {
        $templateName = 'home';
        $args_array = array();

        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
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

    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
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

    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
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
                //->setTo(array('feedback@lilyandlarryllamafarmers.com'))
                ->setTo(array('neilo2000@gmail.com'))
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