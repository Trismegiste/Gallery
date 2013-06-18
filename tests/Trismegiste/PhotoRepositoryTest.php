<?php

/*
 * photobook
 */

namespace Tests\Trismegiste;

/**
 * PhotoRepositoryTest tests PhotoRepository
 */
class PhotoRepositoryTest extends \PHPUnit_Framework_TestCase
{

    protected $repo;

    protected function setUp()
    {
        $this->repo = new \Trismegiste\PhotoRepository(dirname(__DIR__) . '/fixtures', 'photo');
    }

    public function testCategory()
    {
        $cat = $this->repo->findCategory();
        $this->assertEquals([1 => '/photo/1/category.png'], $cat);
    }

    public function testGallery()
    {
        $cat = $this->repo->findAll();
        $this->assertEquals([1 => [0 => ['url' => '/photo/1/img.jpg', 'caption' => 'img']]], $cat);
    }

}