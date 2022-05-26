<?php

namespace Pheuture\Helpers;

require_once __DIR__.'/../../vendor/autoload.php';

// use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
// use Symfony\Component\Filesystem\Path;

class ReadDataFromCSV {

    private $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function getContent() {
        
        $filesystem = new Filesystem();
        if($filesystem->exists(__DIR__ . '/../../storage/data/' . $this->filename)) {
            $fileContent = explode("\n", file_get_contents(__DIR__ . '/../../storage/data/' . $this->filename));
            return $fileContent;
        }
        else {
            print($this->filename . " doesn't exist");
            return null;
        }
    }
}