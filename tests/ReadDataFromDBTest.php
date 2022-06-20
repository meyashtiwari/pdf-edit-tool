<?php

use Pheuture\PdfEditTool\Helpers\ReadDataFromDB;

it('Can make a connection with DB', function() {
    $dbConnection = new ReadDataFromDB('127.0.0.1', 'root', 'pheuture', 'pdf_edit_tool', 'registration');

    expect(
        $dbConnection->connectWithDB()
    )->toBeTrue();
});
