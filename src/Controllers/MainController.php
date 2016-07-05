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
use Silex\Provider\FormServiceProvider;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\Type;

use Symfony\Component\Validator\Constraints as Assert;

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
    public function contactFormAction(Request $request, Application $app)
    {
        $data = array(
            'name' => '',
            'email' => '',
            'message' => ''
        );
        $form = $app['form.factory']->createBuilder(FormType::class, $data)
            ->add('name', TextType::class, array(
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                        'min' => 3
                    ))),
                'attr' => array(
                    'class' => 'uk-form-width-large',
                    'placeholder' => 'Name'
                )))
            ->add('email', EmailType::class, array(
                'constraints' => new Assert\Email(),
                'attr' => array(
                    'class' => 'uk-form-width-large',
                    'placeholder' => 'Yourname@somethingmail.com'
                )))
            ->add('message', TextareaType::class, array(
                'constraints' => array(
                    new Assert\NotBlank(), new Assert\Length(array(
                        'min' => 20
                    ))),
                'attr' => array(
                    'class' => 'uk-form-width-large',
                    'placeholder' => 'Your Message',
                    'rows' => 15
                )
            ))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
        }
        $templateName = 'contact';
        $args_array = array(
            'form' => $form->createView()
        );
        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }
}