<?php

/*
 * Photobook
 */

namespace Trismegiste;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class Controller
{

    protected function getRepo()
    {
        return $app['repository'];
    }

    public function home(Request $request, Application $app)
    {
        if (preg_match('#googlebot#i', $request->server->get('HTTP_USER_AGENT'))) {
            $app->abort(404);
        }

        $param['category'] = $app['repository']->findCategory();
        $param['gallery'] = $app['repository']->findAll();

        return $app->render('home.html.twig', $param);
    }

}