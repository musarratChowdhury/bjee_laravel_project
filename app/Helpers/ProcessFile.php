<?php

namespace App\Helpers;

use App\Models\Submission;
use App\Models\SubmissionAuthor;
use App\Models\SubmissionFile;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use \PhpOffice\PhpWord\IOFactory;
use \PhpOffice\PhpWord\Settings;
use \setasign\Fpdi\Fpdi;

class ProcessFile
{

    public static function showNumberedFile($submissionId, $fileId)
    {

        $numberPdf = self::dirOfNumberedPdf($submissionId);

		// if (file_exists($numberPdf)) {
		// 	header("Content-type: application/pdf");
		// 	echo file_get_contents($numberPdf);
		// 	return;
		// }

		$submission = Submission::find($submissionId);
		// dd($submission);
		$files = SubmissionFile::select('pdf')->where([
			['submission_id', $submissionId],
		])->get();

		// dd($files);
		foreach ($files as $file) {
			$processedPdfs[] = storage_path('app/') . $file->pdf;
		}

		$header = $submission->title ?? 'Journal Project Id # ' . $submission->id;
		$footer = 'Our Journal Website';
		$pdf = new Fpdi;

		$pdf->AddPage();
		$pdf->setSourceFile(self::createCoverPage($submission));
		$pdf->useTemplate($pdf->importPage(1), 0, 0, null, null, false);

		foreach ($processedPdfs as $processedPdf) {

			for ($pageNo = 1; $pageNo <= $pdf->setSourceFile($processedPdf); $pageNo++) {
				$pdf->AddPage();
				$pdf->useTemplate($pdf->importPage($pageNo), 0, 0, null, null, false);
				$pdf->SetFont('Arial', '', 6);

				$pdf->SetXY(5, 5); // header
				$pdf->Cell(0, 5, $header, 0, 0, 'C'); // header

				$SetX = 3;
				$SetY = 15;
				$SetYIncrement = 4.6;
				// $pdf->Cell(100, 10, 'header', 1, 1);
				// $pdf->Text(90, 5, $header);
				// $pdf->Cell(0,5,$header,0,0,'C');
				for ($i = 1; $i < 61; $i++) {
					$pdf->SetXY($SetX, $SetY);
					$pdf->Text($SetX, $SetY, $i); // Side Number
					$SetY = $SetY + $SetYIncrement;
				}
				// $pdf->SetXY(5, -27);
				// $pdf->Cell(0,5,$footer,0,0,'C');
				$pdf->Text(90, $SetY, $footer); // footer

			}
		}
		$pdf->Output($numberPdf, 'F');

        header("Content-type: application/pdf");
        echo file_get_contents($numberPdf);
    }

    public static function createCoverPage($submission)
    {
        // dd($submission);

        $dompdf = new Dompdf();
        // $dompdf->loadHtml('hello world');
        $dompdf->loadHtml(view('pdf/cover', ['submission' => $submission]));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // $dompdf->stream();

        $dir = '/pdf/cover/' . Auth::user()->id . '/';
        Storage::makeDirectory($dir);

        $fileName = storage_path('app') . $dir . $submission->id . '.pdf';

        file_put_contents($fileName, $dompdf->output());

        return $fileName;

    }

    public static function getNumberedFile($submissionId)
    {

        $numberPdf = self::dirOfNumberedPdf($submissionId);
        // die($numberPdf);

        if (!file_exists($numberPdf)) {

            $submission = Submission::find($submissionId);
            $files = SubmissionFile::select('pdf')->where([
                ['submission_id', $submissionId],
            ])->get();

            // dd($files);
            foreach ($files as $file) {
                $processedPdfs[] = storage_path('app/') . $file->pdf;
            }

            $header = $submission->title ?? 'Journal Project Id # ' . $submission->id;
            $footer = 'Our Journal Website';
            $pdf = new Fpdi;

            foreach ($processedPdfs as $processedPdf) {
                for ($pageNo = 1; $pageNo <= $pdf->setSourceFile($processedPdf); $pageNo++) {
                    $pdf->AddPage();
                    $pdf->useTemplate($pdf->importPage($pageNo), 0, 0, null, null, false);
                    $pdf->SetFont('Arial', '', 6);

                    $pdf->SetXY(5, 5); // header
                    $pdf->Cell(0, 5, $header, 0, 0, 'C'); // header

                    $SetX = 3;
                    $SetY = 15;
                    $SetYIncrement = 4.6;
                    // $pdf->Cell(100, 10, 'header', 1, 1);
                    // $pdf->Text(90, 5, $header);
                    // $pdf->Cell(0,5,$header,0,0,'C');
                    for ($i = 1; $i < 61; $i++) {
                        $pdf->SetXY($SetX, $SetY);
                        $pdf->Text($SetX, $SetY, $i); // Side Number
                        $SetY = $SetY + $SetYIncrement;
                    }
                    // $pdf->SetXY(5, -27);
                    // $pdf->Cell(0,5,$footer,0,0,'C');
                    $pdf->Text(90, $SetY, $footer); // footer

                }
            }
            $pdf->Output($numberPdf, 'F');
        }

        header("Content-type: application/pdf");
        echo file_get_contents($numberPdf);
    }
    
    
    public static function createNumberedPDFAuto($submissionId){
        $numberPdf = self::dirOfNumberedPdf($submissionId);
        // dd($numberPdf);
        if (!file_exists($numberPdf)) {

            $submission = Submission::find($submissionId);
            $files = SubmissionFile::select('pdf')->where([
                ['submission_id', $submissionId],
            ])->get();

            // dd($files);
            foreach ($files as $file) {
                $processedPdfs[] = storage_path('app/') . $file->pdf;
            }

            $header = $submission->title ?? 'Journal Project Id # ' . $submission->id;
            $footer = 'Our Journal Website';
            $pdf = new Fpdi;

            foreach ($processedPdfs as $processedPdf) {
                for ($pageNo = 1; $pageNo <= $pdf->setSourceFile($processedPdf); $pageNo++) {
                    $pdf->AddPage();
                    $pdf->useTemplate($pdf->importPage($pageNo), 0, 0, null, null, false);
                    $pdf->SetFont('Arial', '', 6);

                    $pdf->SetXY(5, 5); // header
                    $pdf->Cell(0, 5, $header, 0, 0, 'C'); // header

                    $SetX = 3;
                    $SetY = 15;
                    $SetYIncrement = 4.6;
                    // $pdf->Cell(100, 10, 'header', 1, 1);
                    // $pdf->Text(90, 5, $header);
                    // $pdf->Cell(0,5,$header,0,0,'C');
                    for ($i = 1; $i < 61; $i++) {
                        $pdf->SetXY($SetX, $SetY);
                        $pdf->Text($SetX, $SetY, $i); // Side Number
                        $SetY = $SetY + $SetYIncrement;
                    }
                    // $pdf->SetXY(5, -27);
                    // $pdf->Cell(0,5,$footer,0,0,'C');
                    $pdf->Text(90, $SetY, $footer); // footer

                }
            }
            $pdf->Output($numberPdf, 'F');
        }
    }

    public static function numberedFileLocation($submissionId)
    {

        $numberPdf = self::dirOfNumberedPdf($submissionId);

        if (!file_exists($numberPdf)) {

            $files = SubmissionFile::select('pdf')->where([
                ['submission_id', $submissionId],
            ])->get();

            foreach ($files as $file) {
                $processedPdfs[] = storage_path('app/') . $file->pdf;
            }

            $pdf = new Fpdi;

            foreach ($processedPdfs as $processedPdf) {
                for ($pageNo = 1; $pageNo <= $pdf->setSourceFile($processedPdf); $pageNo++) {
                    $pdf->AddPage();
                    $pdf->useTemplate($pdf->importPage($pageNo), 0, 0, null, null, false);
                    $pdf->SetFont('Arial', '', 9);
                    $SetX = 3;
                    $SetY = 5;
                    $SetYIncrement = 4.6;

                    for ($i = 1; $i < 61; $i++) {
                        $pdf->SetXY($SetX, $SetY);
                        //$pdf->Cell(4, 4.5, "$i", 0, 0, 'L');
                        $pdf->Text($SetX, $SetY, $i);
                        $SetY = $SetY + $SetYIncrement;
                    }
                }
            }
            $pdf->Output($numberPdf, 'F');
        }

        return $numberPdf;
    }

    public static function getNumberedFileOld($submissionId)
    {

        $numberPdf = self::dirOfNumberedPdf($submissionId);

        if (!file_exists($numberPdf)) {

            $supportedExtentions = [
                'pdf' => ['pdf'],
                'word' => ['doc', 'docx'],
                'img' => ['png', 'jpg', 'jpeg'],
            ];

            $files = SubmissionFile::where('submission_id', $submissionId)->where('userid', auth()->user()->id)->orderby('file_order', 'asc')->get();

            foreach ($files as $file) {
                if (in_array($file->extention, $supportedExtentions['pdf'])) {
                    $processedPdfs[] = storage_path('app/') . $file->path;
                }

                if (in_array($file->extention, $supportedExtentions['word'])) {
                    $processedPdfs[] = self::word2pdf($file);
                }

                if (in_array($file->extention, $supportedExtentions['img'])) {
                    $processedPdfs[] = self::img2pdf($file);
                }

            }

            $pdf = new Fpdi;

            foreach ($processedPdfs as $processedPdf) {
                for ($pageNo = 1; $pageNo <= $pdf->setSourceFile($processedPdf); $pageNo++) {

                    $pdf->AddPage();
                    $pdf->useTemplate($pdf->importPage($pageNo), 0, 0, null, null, false);
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
            }

            $pdf->Output('F', $numberPdf);
        }
        header("Content-type: application/pdf");
        // header("Content-Length: " . filesize($numberPdf));
        return readfile($numberPdf);
    }

    public static function deleteSubmissionFile($submissionId, $fileId, $pathOfMainFile = null)
    {

        if (file_exists(self::dirOfConvertedPdf($submissionId, $fileId))) {
            unlink(self::dirOfConvertedPdf($submissionId, $fileId));
        }

        if ($pathOfMainFile !== null) {
            if (file_exists(Storage::path($pathOfMainFile))) {
                unlink(Storage::path($pathOfMainFile));
            }
        }

        self::deleteNumberedFile($submissionId);

        return true;
    }

    public static function deleteNumberedFile($submissionId)
    {
        if (file_exists(self::dirOfNumberedPdf($submissionId))) {
            unlink(self::dirOfNumberedPdf($submissionId));
        }
        return true;
    }

    private static function word2pdf($wordFile)
    {

        $wordFilename = self::dirOfConvertedPdf($wordFile->submissionid, $wordFile->id);

        if (!file_exists($wordFilename)) {
            $domPdfPath = base_path('vendor/dompdf/dompdf');
            Settings::setPdfRendererPath($domPdfPath);
            Settings::setPdfRendererName('DomPDF');

            $phpWord = IOFactory::load(Storage::path($wordFile->path)); // word document location
            $xmlWriter = IOFactory::createWriter($phpWord, 'PDF');
            $xmlWriter->save($wordFilename, array("Attachment" => false));
        }

        return $wordFilename;
    }

    private static function img2pdf($imageFile)
    {

        $imageFilename = self::dirOfConvertedPdf($imageFile->submissionid, $imageFile->id);
        if (!file_exists($imageFilename)) {
            $a4 = [
                'width' => 210 - 20 / 1.1,
                'height' => 297 - 10 / 1.1,
            ];
            list($width, $height) = getimagesize(storage_path('app/') . $imageFile->path);

            $width *= 0.2645833333;
            $height *= 0.2645833333;
            while ($width > $a4['width'] || $height > $a4['height']) { // b
                $width = $width / 1.01;
                $height = $height / 1.01;
            }

            $pdf = new Fpdi('P', 'mm');
            $pdf->AddPage('P', 'A4');
            $pdf->Image(storage_path('app/') . $imageFile->path, 15, 10, $width, $height);
            $pdf->Output($imageFilename, 'F');
        }

        return $imageFilename;
    }

    private static function dirOfConvertedPdf($submissionId, $fileId)
    {
        $dir = '/pdf/converted/' . Auth::user()->id . '-' . $submissionId . '/';
        Storage::makeDirectory($dir);
        return storage_path('app') . $dir . $fileId . '.pdf';
    }

    private static function dirOfNumberedPdf($submissionId)
    {
        $dir = '/pdf/numbered/' . Auth::user()->id . '/';
        Storage::makeDirectory($dir);
        // dd(storage_path('app') . $dir . $submissionId . '.pdf');
        return storage_path('app') . $dir . $submissionId . '.pdf';
    }
}
