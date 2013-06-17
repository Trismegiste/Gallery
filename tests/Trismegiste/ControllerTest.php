<?php

/*
 * photobook
 */

namespace Tests\Trismegiste;

use Silex\WebTestCase;

/**
 * ControllerTest tests the controller
 */
class ControllerTest extends WebTestCase
{

    public function testHomeContent()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isOk());
    }

    public function createApplication()
    {
        require dirname(__DIR__) . '/../web/index.php';
        $app['debug'] = true;
        $app['exception_handler']->disable();

        return $app;
    }

}