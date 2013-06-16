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
            $name = $entry->getRelativePathname();
            list($subdir, $cat, $rest) = explode(DIRECTORY_SEPARATOR, $name);
            $result[$cat] = '/' . str_replace(DIRECTORY_SEPARATOR, '/', $name);
        }

        return $result;
    }

    public function findAll()
    {
        $f = new Finder();
        $f->files()
                ->in($this->webRoot)
                ->path($this->photoDir)
                ->name('*.JPG');

        $result = [];
        foreach ($f as $entry) {
            $name = $entry->getRelativePathname();
            list($subdir, $cat, $rest) = explode(DIRECTORY_SEPARATOR, $name);
            $result[$cat][] = '/' . str_replace(DIRECTORY_SEPARATOR, '/', $name);
        }

        return $result;
    }

}