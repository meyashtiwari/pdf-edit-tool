<?php 

require_once __DIR__.'/../src/GeneratePdf.php';

use Pheuture\PdfEditTool\GeneratePdf;


if($argc == 1) {
    print('Pass file names to process');
    return;
}

$tool = new GeneratePdf();

for($count = 1; $count < $argc; $count++) {
    $tool->generate($argv[$count]);
}