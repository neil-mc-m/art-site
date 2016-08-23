<?php
namespace Art\Controllers;

use Art\UpdateType;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

Class AdminController
{

    /**
     * render the login form. pass errors and last username if there was a failed attempt to login.
     *
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
     * set the user in the session if successfully logged in and render the admin dashboard/homepage.
     * also gets a list of current exhibitions in the database.
     *
     * @param Application $app
     * @return mixed
     */
    public function dashboardAction(Application $app)
    {
        $user = $app['security.token_storage']->getToken()->getUser()->getUsername();
        $app['session']->set('user', array('username' => $user));
        $exhibitions = $app['dbrepo']->getAllExhibitions();

        $templateName = 'dashboard';
        $args_array = array(
            'user' => $app['session']->get('user'),
            'exhibitions' => $exhibitions
        );
        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }
    /**
     * builds a form for creating a new entry on the exhibitions page.
     * uses a custom form src/UpdateType.php
     *
     * @param Application $app
     * @return mixed
     */
    public function createExhibitionAction(Request $request, Application $app)
    {
        $count = 0;
        $data = array(
            'name' => '',
            'location' => '',
            'type' => ''
        );
        $form = $app['form.factory']
            ->createBuilder(UpdateType::class, $data)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $count = $app['dbrepo']->createNewExhibition($data);
        }


        $templateName = 'createExhibition';
        $args_array = array(
            'form' => $form->createView(),
            'count' => $count
        );

        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }

    public function deleteExhibitionAction(Application $app, $id)
    {
        $count = $app['dbrepo']->deleteExhibitionById($id);
        $exhibitions = $app['dbrepo']->getAllExhibitions();
        $templateName = 'dashboard';

        $args_array = array(
            'count' => $count,
            'exhibitions' => $exhibitions
        );
        return $app['twig']->render($templateName.'.html.twig', $args_array);
    }
}
