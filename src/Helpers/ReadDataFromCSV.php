<?php

namespace Pheuture\PdfEditTool\Helpers;

require_once __DIR__.'/../../vendor/autoload.php';

use Pheuture\PdfEditTool\Contracts\ReadDataContract;
use Symfony\Component\Filesystem\Filesystem;
class ReadDataFromCSV implements ReadDataContract{

    public function __construct(
        private string $filename
    ){}

    public function getContent(): mixed {
        
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