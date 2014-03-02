<?php

/*
 * Photobook
 */

namespace Trismegiste;

use Silex\Application;
use Silex\Provider\TwigServiceProvider;

/**
 * AppKernel is the kernel of this app
 */
class AppKernel extends Application
{

    use Application\TwigTrait;

    public function __construct(array $values = array())
    {
        parent::__construct($values);

        // services
        $this->register(new TwigServiceProvider(), [
            'twig.path' => dirname($this['webdir']) . '/views',
            'twig.options' => ['cache' => dirname($this['webdir']) . '/cache']
        ]);

        $this['repository'] = $this->share(function ($app) {
                    return new PhotoRepository($app['webdir']);
                });

        // routes
        $this->get('/', 'Trismegiste\Controller::home');
    }

}