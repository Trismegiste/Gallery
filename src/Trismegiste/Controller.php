<?php

/*
 * Photobook
 */

namespace Trismegiste;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class Controller
{

    public function home(Request $request, Application $app)
    {
        $param['category'] = $app->getRepo()->findCategory();

        return $app->render('home.html.twig', $param);
    }

}