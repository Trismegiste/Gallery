<?php

// web/index.php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Trismegiste\AppKernel();

$app['debug'] = true;
$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => dirname(__DIR__) . '/views',
    'twig.options' => ['cache' => dirname(__DIR__) . '/cache']
]);

$app->get('/', 'Trismegiste\Controller::home');
$app->run();