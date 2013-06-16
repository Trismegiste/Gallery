<?php

/*
 * Photobook
 */

namespace Trismegiste;

use Symfony\Component\Finder\Finder;

/**
 * PhotoRepository is a dao for photos
 */
class PhotoRepository
{

    protected $webRoot;
    protected $photoDir;

    public function __construct($webdir, $photodir)
    {
        $this->webRoot = $webdir;
        $this->photoDir = $photodir;
    }

    public function findCategory()
    {
        $f = new Finder();
        $f->files()
                ->in($this->webRoot)
                ->path($this->photoDir)
                ->name('category.png');

        $result = [];
        foreach ($f as $entry) {
            $result[] = '/' . str_replace(DIRECTORY_SEPARATOR, '/', $entry->getRelativePathname());
        }

        return $result;
    }

    public function findAll()
    {
        
    }

}