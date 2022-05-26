<?php

/**
 * This file is part of pheuture/pdfedittool
 *
 * pheuture/pdfedittool is open source software: you can
 * distribute it and/or modify it under the terms of the MIT License
 * (the "License"). You may not use this file except in
 * compliance with the License.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or
 * implied. See the License for the specific language governing
 * permissions and limitations under the License.
 *
 * @copyright Copyright (c) Pheuture Studio Pvt Ltd. <support@pheuture.com>
 * @license https://opensource.org/licenses/MIT MIT License
 */

namespace Pheuture\PdfEditTool;
require_once __DIR__.'/../src/Helpers/ReadDataFromCSV.php';
require_once __DIR__.'/../vendor/autoload.php';

use setasign\Fpdi\Fpdi;
use Pheuture\Helpers\ReadDataFromCSV;

class GeneratePdf
{
    public function generate($file)
    {
        $readData = new ReadDataFromCSV($file);
        $data = $readData->getContent();
        if($data !== null) {
            array_shift($data); //Removed head from content.

            array_map(function($record) {
                $this->insertDataAndGeneratePdf($record);
            }, $data);
        }
    }

    public function insertDataAndGeneratePdf($record) {
        $record = explode(',', $record);

        $pdf = new Fpdi('p');

        // Reference the PDF you want to use (use relative path)
        $pagecount = $pdf->setSourceFile( __DIR__ . '/../storage/' . 'template.pdf' );
        // Import the first page from the PDF and add to dynamic PDF
        $tpl = $pdf->importPage(1);
        $pdf->AddPage();

        // Use the imported page as the template
        $pdf->useTemplate($tpl);

        // Set the default font to use
        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize('7'); // set font size

        // adding a Cell using:
        // $pdf->Cell( $width, $height, $text, $border, $fill, $align);

        // date
        $pdf->SetXY(2, 33);
        $pdf->Cell(0, 10, $record[0], 0, 0, 'C');

        // Name
        $pdf->SetXY(25, 40); // set the position of the box
        $pdf->Cell(145, 10, $record[1], 0, 0, 'L'); // add the text, align to Center of cell

        // Address
        $pdf->SetXY(25, 40);
        $pdf->Cell(145, 10, $record[2], 0, 0, 'R');

        // Pincode
        $pdf->SetXY(25, 43);
        $pdf->Cell(145, 10, $record[3], 0, 0, 'L');

        // Telephone Number
        $pdf->SetXY(70, 43);
        $pdf->Cell(145, 10, $record[4], 0, 0, 'L');

        // Fax Number
        $pdf->SetXY(35, 43);
        $pdf->Cell(145, 10, $record[5], 0, 0, 'C');

        // Website
        $pdf->SetXY(18, 43);
        $pdf->Cell(145, 10, $record[6], 0, 0, 'R');

        // Adding remaning pages in output pdf
        for($count = 2; $count <= $pagecount; $count++) {
            $tpl = $pdf->importPage($count);
            $pdf->AddPage();
            $pdf->useTemplate($tpl);
        }


        // save pdf
        $pdf->Output('F', __DIR__ . '/../storage/output/' . 'file-' . str_replace(' ', '-', $record[1]) . '.pdf');
        print('file-' . str_replace(' ', '-', $record[1]) . '.pdf Created Succesfully in storage/output' . PHP_EOL);
    }
}