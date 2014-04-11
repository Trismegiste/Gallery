<?php

/*
 * Photobook
 */

namespace Trismegiste;

use Symfony\Component\Finder\Finder;

/**
 * PhotoRepository is a readonly dao for photos
 */
class PhotoRepository
{

    protected $webRoot;
    protected $photoDir;

    public function __construct($webdir, $photoSubdir = 'photo')
    {
        $this->webRoot = $webdir;
        $this->photoDir = $photoSubdir;
    }

    /**
     * Finds all categories in photo directory
     * 
     * @return array
     */
    public function findCategory()
    {
        $result = [];
        $fnd = $this->getDefaultFinder()->name('category.png');

        $this->genericScan($fnd, function($categ, $name) use (&$result) {
                    $result[$categ] = $name;
                });

        return $result;
    }

    /**
     * Gets a caption from a filepath
     * 
     * @param string $filepath
     * @return string
     */
    protected function humanize($filepath)
    {
        return str_replace('_', ' ', basename($filepath, '.jpg'));
    }

    public function findAll()
    {
        $result = [];
        $fnd = $this->getDefaultFinder()->name('#\.jpg$#i');

        $this->genericScan($fnd, function($categ, $name) use (&$result) {
                    $result[$categ][] = ['url' => $name, 'caption' => $this->humanize($name)];
                });

        return $result;
    }

    /**
     * Builds a finder with default value for stuff in webdir
     * 
     * @return \Symfony\Component\Finder\Finder
     */
    protected function getDefaultFinder()
    {
        $f = new Finder();
        $f->files()
                ->in($this->webRoot)
                ->path('#' . $this->photoDir . '/\d/#')
                ->sortByName();

        return $f;
    }

    protected function genericScan(Finder $fnd, \Closure $callback)
    {
        foreach ($fnd as $entry) {
            $name = $entry->getRelativePathname();
            list($subdir, $cat, $rest) = explode(DIRECTORY_SEPARATOR, $name);
            call_user_func($callback, $cat, '/' . str_replace(DIRECTORY_SEPARATOR, '/', $name));
        }
    }

}