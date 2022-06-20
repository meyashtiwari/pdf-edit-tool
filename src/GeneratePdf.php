<?php

namespace Pheuture\PdfEditTool;

use setasign\Fpdi\Fpdi;
use Pheuture\PdfEditTool\Helpers\ReadDataFromCSV;
use Pheuture\PdfEditTool\Contracts\GeneratePdfContract;

class GeneratePdf implements GeneratePdfContract
{
    public function makeFromCSV(string $fileName): bool
    {
        $readData = new ReadDataFromCSV($fileName);
        $data = $readData->getContent();
        if($data !== null) {
            array_shift($data); //Removed head from content.

            array_map(function(array $record) {
                $this->insertDataAndGeneratePdf($record);
            }, $data);

            return true;
        }
        return false;
    }

    public function make(array $dataToInsert = []): bool
    {
        
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