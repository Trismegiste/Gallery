<?php

/*
 * Photobook
 */

namespace Trismegiste;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

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

        $controllers->before(function(Request $request) {
                            if (preg_match('#googlebot#i', $request->server->get('HTTP_USER_AGENT'))) {
                                throw new HttpException(404);
                            }
                        })
                ->get('/', __CLASS__ . '::home');

        return $controllers;
    }

}