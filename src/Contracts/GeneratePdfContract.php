<?php

declare(strict_types=1);

namespace Pheuture\PdfEditTool\Contracts;

interface GeneratePdfContract {

    public function make(array $dataToInsert = []): bool;
}