<?php

/*
 * Photobook
 */

namespace Trismegiste;

use Silex\Application;

/**
 * AppKernel is the kernel of this app
 */
class AppKernel extends Application
{

    use Application\TwigTrait;

    public function getRepo()
    {
        return $this['repository'];
    }

}