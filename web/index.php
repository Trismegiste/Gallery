<?php

// web/index.php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Trismegiste\AppKernel();

$app['debug'] = true;
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => dirname(__DIR__) . '/views',
));

$app->get('/', 'Trismegiste\Controller::home');
$app->run();