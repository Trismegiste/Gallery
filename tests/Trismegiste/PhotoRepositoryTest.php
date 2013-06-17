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
        $this->repo = new \Trismegiste\PhotoRepository(dirname(__DIR__), 'fixtures');
    }

    public function testCategory()
    {
        $cat = $this->repo->findCategory();
        $this->assertEquals([1 => '/fixtures/1/category.png'], $cat);
    }

    public function testGallery()
    {
        $cat = $this->repo->findAll();
        $this->assertEquals([1 => [0 => '/fixtures/1/img.jpg']], $cat);
    }

}