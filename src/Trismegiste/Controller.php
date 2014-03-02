<?php

/*
 * Photobook
 */

namespace Trismegiste;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Main controller
 */
class Controller implements ControllerProviderInterface
{

    /**
     * The single page
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Silex\Application $app
     * 
     * @return \Symfony\Component\HttpFoundation\Response response
     */
    public function home(Request $request, Application $app)
    {
        if (preg_match('#googlebot#i', $request->server->get('HTTP_USER_AGENT'))) {
            $app->abort(404);
        }

        $param['category'] = $app['repository']->findCategory();
        $param['gallery'] = $app['repository']->findAll();

        return $app->render('home.html.twig', $param);
    }

    /**
     * @inheritdoc
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];
        $controllers->get('/', __CLASS__ . '::home');

        return $controllers;
    }

}