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
        return "wesh";
    }

}