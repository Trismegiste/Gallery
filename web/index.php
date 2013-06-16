<?php

// web/index.php

require_once dirname(__DIR__) . '/vendor/autoload.php';

$app = new Trismegiste\AppKernel();

// config
$app['debug'] = true;
$app['webdir'] = __DIR__;

// services
$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => dirname(__DIR__) . '/views',
    'twig.options' => ['cache' => dirname(__DIR__) . '/cache']
]);

$app['repository'] = function ($app) {
            return new Trismegiste\PhotoRepository($app['webdir'], 'photo');
        };

// run
$app->get('/', 'Trismegiste\Controller::home');
$app->run();