<?php

// web/index.php

require_once dirname(__DIR__) . '/vendor/autoload.php';

$app = new Trismegiste\AppKernel(['debug' => true, 'webdir' => __DIR__]);

$app->run();