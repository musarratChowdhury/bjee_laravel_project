<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use \PhpOffice\PhpWord\IOFactory;
use \PhpOffice\PhpWord\Settings;
use \setasign\Fpdi\Fpdi;

class TestController extends Controller
{

	public function index()
	{

		$pdf = new Fpdi;

		// pdf document location
		for ($pageNo = 1; $pageNo <= $pdf->setSourceFile('directr-pdf.pdf'); $pageNo++) {

			$pdf->AddPage();
			$pdf->useTemplate($pdf->importPage($pageNo), 0, 0, null, null, true);
			$pdf->SetFont('Arial', '', 9);

			$SetX = 3;
			$SetY = 5;
			$SetYIncrement = 4.6;

			$pdf->Text(round($pdf->GetPageWidth() / 2), $SetY, "Header Line");

			for ($i = 1; $i < 61; $i++) {
				$pdf->SetXY($SetX, $SetY);
				//$pdf->Cell(4, 4.5, "$i", 0, 0, 'L');
				$pdf->Text($SetX, $SetY, $i);
				$SetY = $SetY + $SetYIncrement;
			}

			$pdf->Text(round($pdf->GetPageWidth() / 2), $SetY - $SetYIncrement, "Footer Line");
		}

		$pdf->Output();
	}

	public function word2pdf()
	{
		$domPdfPath = base_path('vendor/dompdf/dompdf');
		Settings::setPdfRendererPath($domPdfPath);
		Settings::setPdfRendererName('DomPDF');

		//Load temp file
		$phpWord = IOFactory::load('sample2.docx'); // word document location

		//Save it
		$xmlWriter = IOFactory::createWriter($phpWord, 'PDF');

		
		$xmlWriter->save('sample2-word-2-pdf.pdf', array("Attachment" => false));  // pdf output document location
		//$xmlWriter->stream('sample2.pdf');
	}


	public function index111()
	{

		$pdf = new Fpdi;

		$pdf->AddPage();
		$pdf->setSourceFile('pdf.pdf');

		echo $pdf->AliasNbPages();

		// We import only page 1
		// Let's use it as a template from top-left corner to full width and height
		$pdf->useTemplate($pdf->importPage(1), 0, 0, null, null, true);

		// Set font and color
		$pdf->SetFont('Arial', '', 9); // Font Name, Font Style (eg. 'B' for Bold), Font Size
		//$pdf->SetTextColor(0, 0, 0); // RGB

		// Position our "cursor" to left edge and in the middle in vertical position minus 1/2 of the font size
		//$pdf->SetXY(3, 5);
		// Add text cell that has full page width and height of our font
		//$pdf->Cell(3, 200, $sideNumbers, '1', 0, 'L');

		//$pdf->Text(1,3,"dasdas \nasdsad");
		$pdf->GetPageWidth();
		$pdf->GetPageHeight();
		$pdf->Text(round($pdf->GetPageWidth() / 2), 5, "Header");
		//$pdf->Text(round($pdf->GetPageWidth() / 2),0,"Footer");
		$pdf->Cell(0, -100, "footer", 0, 1, "C");

		// $pdf->SetXY(1, 3);
		// $pdf->Cell(4, 4, "1", 1, 0, 'C');
		// $pdf->SetXY(1, 7);
		// $pdf->Cell(4, 4, "2", 1, 0, 'C');

		$SetX = 3;
		$SetY = 10;
		$SetYIncrement = 4;
		for ($i = 1; $i < 61; $i++) {
			$pdf->SetXY($SetX, $SetY);
			$pdf->Cell(4, 4.5, "$i", 0, 0, 'L');
			$SetY = $SetY + $SetYIncrement;
		}

		// $y = 5;
		// for ($i=0; $i < 5; $i++) {
		//     $pdf->SetXY(3, $y++);
		//     $pdf->Cell(1, 5, $i, '1', 0, 'L');
		//     // $pdf->Text(1,($i+10),$i);
		//     // $pdf->Ln();
		// }

		$pdf->Output();
		die();
		// Output our new pdf into a file
		// F = Write local file
		// I = Send to standard output (browser)
		// D = Download file
		// S = Return PDF as a string
		$pdf->Output('/tmp/new-file.pdf', 'F');

		// ---------------------------------------------------------

		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$pdf->Output('example_001.pdf', 'I');
	}

	public function pdfToBrowser()
	{
		$pdf = new Fpdi();
		$pdf->setSourceFile('pdf.pdf');
		$tplId = $pdf->importPage(1);
		$pdf->AddPage();
		// use the imported page and place it at point 10,10 with a width of 100 mm
		$pdf->useTemplate($tplId);

		$pdf->Output();
	}



	public function htmlToPdf()
	{
		$dompdf = new Dompdf();
		$dompdf->loadHtml('hello world');

		// (Optional) Setup the paper size and orientation
		//$dompdf->setPaper('A4', 'landscape');

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream('dompdf_out.pdf', array("Attachment" => false));
	}
}
