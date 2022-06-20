<?php

declare(strict_types=1);

namespace Pheuture\PdfEditTool\Contracts;

interface ReadDataContract {

    public function getContent(): mixed;
}