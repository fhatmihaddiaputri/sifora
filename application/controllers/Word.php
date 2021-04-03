<?php

defined('BASEPATH') OR exit('No direct script access allowed');
//require_once(BASE_URL().'vendor\tecnickcom\tcpdf\examples\tcpdf_include.php');

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use NcJoes\OfficeConverter\OfficeConverter;

class Word extends CI_Controller {
function __construct(){
    parent::__construct();
    $this->load->model('Panitera_model');
    $this->load->model('PDF_Model');
  }

	public function index()
	{$this->load->helper('download');


		$filename= APPPATH."docx\SK_autentik.docx";
			echo date('H:i:s') , ' Creating new TemplateProcessor instance...' ;
			$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($filename);
			$templateProcessor->setValue('TglTTD','123');
			$templateProcessor->setValue('NomorSK','123');
			$templateProcessor->setValue('NamaDirjen','123');
			$templateProcessor->setValue('NamaPT','123');
			$templateProcessor->setValue('NamaPN','123');
			$templateProcessor->setValue('NamaKPPN','123');
			

			
			$pathToSave = APPPATH.'docx\coba3.docx';
			$templateProcessor->saveAs($pathToSave);


			// Make sure you have `tecnickcom/tcpdf` in your composer dependencies.
//Settings::setPdfRendererName(Settings::PDF_RENDERER_TCPDF);
// Path to directory with tcpdf.php file.
// Rigth now `TCPDF` writer is depreacted. Consider to use `DomPDF` or `MPDF` instead.
//Settings::setPdfRendererPath('vendor/tecnickcom/tcpdf');



			 $phpWord = \PhpOffice\PhpWord\IOFactory::load($pathToSave);

			 $objReader = \PhpOffice\PhpWord\IOFactory::createReader("Word2007"); 
			 $phpWord= $objReader->load($pathToSave);


			 Settings::setPdfRendererName(Settings::PDF_RENDERER_TCPDF);
// Path to directory with tcpdf.php file.
// Rigth now `TCPDF` writer is depreacted. Consider to use `DomPDF` or `MPDF` instead.
Settings::setPdfRendererPath('vendor/tecnickcom/tcpdf');

			  $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord,'PDF');
			  $xmlWriter->save(APPPATH.'docx\cobaaja.pdf');
			 // $pdf = new \TCPDF();
			 // $pdf->writeHTML($xmlWriter);
			//ob_end_clean();
			//$pdf->Output(APPPATH.'docx\tt.pdf','I');


/*$phpWord = IOFactory::load($pathToSave, 'Word2007');

$phpWord->save(APPPATH.'docx\document.pdf', 'PDF');
force_download(APPPATH.'docx\document.pdf', NULL);
*/

	}


	public function getPanitera(){
		 log_message("debug", "Masuk word");
       
			echo "masuk";
	$where = array('nodrp' => '7' );
		$hasil= $this->Panitera_model->get_data($where);
		//var_dump($hasil);
	}


	function generateSKKPPanitera($data){

		$filename= APPPATH."docx\SK_KPO_PANITERA.docx";
					echo date('H:i:s') , ' Creating new TemplateProcessor instance...' ;
					$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($filename);
					$templateProcessor->setValue('TanggalSK','123');
					$templateProcessor->setValue('NomorSK','123');
					$templateProcessor->setValue('NoPertek','123');
					$templateProcessor->setValue('TglPertek','123');
					$templateProcessor->setValue('Nama','123');
					$templateProcessor->setValue('TptLahir','123');
					$templateProcessor->setValue('TglLahir','123');
					$templateProcessor->setValue('NIP','123');
					$templateProcessor->setValue('Pendidikan','123');
					$templateProcessor->setValue('Pangkat','123');
					$templateProcessor->setValue('GolLama','123');
					$templateProcessor->setValue('TmtGolLama','123');
					$templateProcessor->setValue('Jabatan','123');
					$templateProcessor->setValue('UnitKerja','123');
					$templateProcessor->setValue('GolBaru','123');
					$templateProcessor->setValue('mkTahun','123');
					$templateProcessor->setValue('mkBulan','123');
					$templateProcessor->setValue('Gapok','123');
					$templateProcessor->setValue('TerbilangGapok','123');
					$templateProcessor->setValue('QrCode','123');
					

					
					$pathToSave = APPPATH.'docx\coba3.docx';
					$templateProcessor->saveAs($pathToSave);
		// if you are using composer, just use this
		
		$converter = new OfficeConverter($pathToSave);
		$converter->convertTo('output-file.pdf'); //generates pdf file in same directory as test-file.docx
	//$converter->convertTo('output-file.html'); //generates html file in same directory as test-file.docx

		//to specify output directory, specify it as the second argument to the constructor
		$converter = new OfficeConverter($pathToSave, 'path-to-outdir');
		//$converter = new OfficeConverter('test-file.docx', APPPATH.'docx');

	}

	public function tespdf(){
				$filename= APPPATH."docx\SK_autentik.docx";
					echo date('H:i:s') , ' Creating new TemplateProcessor instance...' ;
					$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($filename);
					$templateProcessor->setValue('TglTTD','123');
					$templateProcessor->setValue('NomorSK','123');
					$templateProcessor->setValue('NamaDirjen','123');
					$templateProcessor->setValue('NamaPT','123');
					$templateProcessor->setValue('NamaPN','123');
					$templateProcessor->setValue('NamaKPPN','123');
					

					
					$pathToSave = APPPATH.'docx\coba3.docx';
					$templateProcessor->saveAs($pathToSave);
		// if you are using composer, just use this
		
		$converter = new OfficeConverter($pathToSave);
		$converter->convertTo('output-file.pdf'); //generates pdf file in same directory as test-file.docx
	//$converter->convertTo('output-file.html'); //generates html file in same directory as test-file.docx

		//to specify output directory, specify it as the second argument to the constructor
		$converter = new OfficeConverter($pathToSave, 'path-to-outdir');
		//$converter = new OfficeConverter('test-file.docx', APPPATH.'docx');

	}







	public function tes()
	{$this->load->helper('download');


		$filename= APPPATH."docx\SK_autentik.docx";
			echo date('H:i:s') , ' Creating new TemplateProcessor instance...' ;
			$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($filename);
			$templateProcessor->setValue('TglTTD','123');
			$templateProcessor->setValue('NomorSK','123');
			$templateProcessor->setValue('NamaDirjen','123');
			$templateProcessor->setValue('NamaPT','123');
			$templateProcessor->setValue('NamaPN','123');
			$templateProcessor->setValue('NamaKPPN','123');
			

			
			$pathToSave = APPPATH.'docx\coba3.docx';
			$templateProcessor->saveAs($pathToSave);



// create new PDF document

			 $objReader = \PhpOffice\PhpWord\IOFactory::createReader("Word2007"); 
			 $phpWord= $objReader->load($pathToSave);


			 Settings::setPdfRendererName(Settings::PDF_RENDERER_TCPDF);
// Path to directory with tcpdf.php file.
// Rigth now `TCPDF` writer is depreacted. Consider to use `DomPDF` or `MPDF` instead.
Settings::setPdfRendererPath('vendor/tecnickcom/tcpdf');

			  $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord,'PDF');
			  //$xmlWriter->save(APPPATH.'docx\cobaaja.pdf');

		  $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord,'PDF');
			//  $xmlWriter->save(APPPATH.'docx\cobaaja.pdf');
			 // $pdf = new \TCPDF();
			  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$utf8text = file_get_contents($xmlWriter, true);

$pdf->SetFont('freeserif', '', 12);
// now write some text above the imported page
$pdf->SetFooter(base_url().'|{PAGENO}|'.$tgl_cetak); 

$pdf->Write(5, $utf8text);

$pdf->Output(APPPATH.'docx\cobaaja.pdf', 'FI');


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_028.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+



	}

public function qrcode($data)
	{


		$this->PDF_Model->qrcode($data);
		/*$this->load->library('ciqrcode'); //meload library barcode
		$this->load->helper('url'); //meload helper url untuk aktifkan base urlnya
        $barcode_create=$data; // membuat code barcode yang nilainya 123456789

        //settingang pada barcode 
        $params['data'] = $barcode_create;
		$params['level'] = 'H';
		$params['size'] =5;

		//settingan untuk membuat file barcode dalam format .png dan di simpan dalam folder assets
		$params['savename'] = FCPATH . "assets/".$barcode_create.".png";
		//mulai menggenerate barcode
		$this->ciqrcode->generate($params);

		//mencoba mengeluarkan nilai barcode yang baru saja di generate
		echo '<img src="'.base_url().'assets/'.$barcode_create.'.png" />';*/
	}

}