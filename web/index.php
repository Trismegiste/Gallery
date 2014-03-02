<?php

// web/index.php

require_once dirname(__DIR__) . '/vendor/autoload.php';

$app = new Trismegiste\AppKernel(['debug' => false, 'webdir' => __DIR__]);

$app->run();