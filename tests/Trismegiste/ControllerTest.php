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

    public function createApplication()
    {
        return new \Trismegiste\AppKernel(['debug' => true, 'webdir' => dirname(__DIR__)]);
    }

    public function testHomeContent()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isOk());
        $result = $crawler->filterXPath('//div/a[@id]/img');
        $this->assertCount(1, $result);
        $this->assertEquals('/fixtures/photo/1/category.png', $result->attr('src'));
        $this->assertRegExp('#img\.jpg#', $client->getResponse()->getContent());
    }

    public function testGoogleDenied()
    {
        $client = $this->createClient(['HTTP_USER_AGENT' => 'googlebot']);
        $crawler = $client->request('GET', '/');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

}