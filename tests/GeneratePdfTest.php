<?php

use Pheuture\PdfEditTool\GeneratePdf;

it('can create a pdf file', function() {
    $generator = GeneratePdf::make(

    );

    expect(
        $generator->generate()
    )->toBeEmpty();
});
