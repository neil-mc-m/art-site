<?php
namespace Art\Controllers;

use Art\UpdateType;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

Class AdminController
{

    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function loginAction(Request $request, Application $app)
    {
        $args_array = array(
            'error' => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
        );
        $templateName = 'login';
        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }
    /**
     * @param Application $app
     * @return mixed
     */
    public function dashboardAction(Request $request, Application $app)
    {
        $data = array(
            'name' => '',
            'location' => '',
            'type' => '',
        );
        $form = $app['form.factory']
            ->createBuilder(UpdateType::class, $data)
            ->getForm();
        $form->handleRequest($request);
        $user = $app['user'];
        $app['session']->set('user', array('username' => $user));
        $templateName = 'dashboard';
        $args_array = array(
            'form' => $form->createView()
        );

        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }
}
