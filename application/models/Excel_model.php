<?php  
/**
 * 
 */
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Excel_model extends CI_Model
{
	
	function exportToExcel($filename, $data){

    $this->load->helper('download'); 

	  var_dump($data);


	  //array(1) { ["skkp"]=> array(1) { [0]=> array(43) { ["id"]=> string(3) "198" ["skpangkatnoid"]=> string(2) "15" ["skpangkatindx"]=> string(1) "1" ["nip"]=> string(18) "197510042014081003" ["nama"]=> string(31) "KUKUH YUDA ARI SANJAYA, SE., SH" ["tempat_lahir"]=> string(6) "KEDIRI" ["tgl_lahir"]=> string(10) "1975-10-04" ["sknmrpertek"]=> string(14) "AI-13001000128" ["sktglpertek"]=> string(10) "2020-08-06" ["sknomor"]=> string(26) "1688/DJU/SK/KP04.1/12/2020" ["sktgl"]=> string(10) "2020-12-17" ["gol_baru"]=> string(5) "III/b" ["tmt_gol_baru"]=> string(10) "2020-10-01" ["mk_tahun"]=> string(2) "13" ["mk_bulan"]=> string(1) "9" ["tmt_gol_lama"]=> string(10) "2016-10-01" ["gol_lama"]=> string(5) "III/a" ["pt"]=> string(8) "Surabaya" ["pn"]=> string(6) "Bangil" ["jabatan"]=> string(18) "Jurusita Pengganti" ["pendidikan"]=> string(38) "SH UNIVERSITAS YOS SOEDARSO TAHUN 2018" ["gaji"]=> string(7) "3238300" ["tunjangan"]=> string(6) "225000" ["qrcode"]=> string(30) "8ae483c573bf74350173c238c77761" ["id_stage"]=> string(1) "5" ["id_status"]=> string(1) "6" ["updated_date"]=> string(19) "2021-04-02 17:42:45" ["updated_user_id"]=> string(1) "7" ["keterangan"]=> string(17) "revisi ya namanya" ["file_loc"]=> string(81) "C:\xampp\htdocs\sifora\application\docx\SKKP_Panitera\15_1_197510042014081003.pdf" ["user_id"]=> string(1) "7" ["NIP"]=> string(0) "" ["user_name"]=> string(6) "danang" ["user_password"]=> string(32) "e10adc3949ba59abbe56e057f20f883e" ["user_email"]=> string(16) "danang@gmail.com" ["user_id_jab"]=> string(2) "12" ["reset_key"]=> string(0) "" ["status"]=> string(6) "REVISI" ["alert_color"]=> string(7) "warning" ["stage_name"]=> string(11) "STAF-PROSES" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "5" } } }
      $spreadsheet = new Spreadsheet();
 
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', 'ID_Group');
      $sheet->setCellValue('B1', 'ID_SK');
      $sheet->setCellValue('C1', 'nip');
      $sheet->setCellValue('D1', 'nama');
      $sheet->setCellValue('E1', 'jabatan');
      $sheet->setCellValue('F1', 'PT');
      $sheet->setCellValue('G1', 'PN');
      $sheet->setCellValue('H1', 'tempat_lahir');
      $sheet->setCellValue('I1', 'tgl_lahir');
      $sheet->setCellValue('J1', 'sknmrpertek');
      $sheet->setCellValue('K1', 'sktglpertek');
      $sheet->setCellValue('L1', 'sknomor');
      $sheet->setCellValue('M1', 'sktgl');
      $sheet->setCellValue('N1', 'gol_baru');
      $sheet->setCellValue('O1', 'tmt_gol_baru'); 
      $sheet->setCellValue('P1', 'mk_tahun');
      $sheet->setCellValue('Q1', 'mk_bulan');
      $sheet->setCellValue('R1', 'tmt_gol_lama');
      $sheet->setCellValue('S1', 'gol_lama');
      $sheet->setCellValue('T1', 'pendidikan');
      $sheet->setCellValue('U1', 'gaji');
      $sheet->setCellValue('V1', 'stage_name');      
      $sheet->setCellValue('W1', 'status');
      $rows = 2;
 		$no=1;
      foreach ($data as $val){
      	$no++;
         /* $sheet->setCellValue('A' . $rows, $val['id']);
          $sheet->setCellValue('B' . $rows, $val['name']);
          $sheet->setCellValue('C' . $rows, $val['skills']);
          $sheet->setCellValue('D' . $rows, $val['address']);
          $sheet->setCellValue('E' . $rows, $val['age']);
          $sheet->setCellValue('F' . $rows, $val['designation']);
			*/
		$sheet->setCellValue('A'.$rows, $val[0]['skpangkatnoid']);
      $sheet->setCellValue('B'.$rows, $val[0]['skpangkatindx']);
      $sheet->setCellValue('C'.$rows, '\''.$val[0]['nip']);
      $sheet->setCellValue('D'.$rows, $val[0]['nama']);
      $sheet->setCellValue('E'.$rows, $val[0]['jabatan']);
      $sheet->setCellValue('F'.$rows, $val[0]['pt']);
      $sheet->setCellValue('G'.$rows, $val[0]['pn']);
      $sheet->setCellValue('H'.$rows, $val[0]['tempat_lahir']);
      $sheet->setCellValue('I'.$rows, $val[0]['tgl_lahir']);
      $sheet->setCellValue('J'.$rows, $val[0]['sknmrpertek']);
      $sheet->setCellValue('K'.$rows, $val[0]['sktglpertek']);
      $sheet->setCellValue('L'.$rows, $val[0]['sknomor']);
      $sheet->setCellValue('M'.$rows, $val[0]['sktgl']);
      $sheet->setCellValue('N'.$rows, $val[0]['gol_baru']);
      $sheet->setCellValue('O'.$rows, $val[0]['tmt_gol_baru']); 
      $sheet->setCellValue('P'.$rows, $val[0]['mk_tahun']);
      $sheet->setCellValue('Q'.$rows, $val[0]['mk_bulan']);
      $sheet->setCellValue('R'.$rows, $val[0]['tmt_gol_lama']);
      $sheet->setCellValue('S'.$rows, $val[0]['gol_lama']);
      $sheet->setCellValue('T'.$rows, $val[0]['pendidikan']);
      $sheet->setCellValue('U'.$rows, $val[0]['gaji']);
      $sheet->setCellValue('V'.$rows, $val[0]['stage_name']);      
      $sheet->setCellValue('W'.$rows, $val[0]['status']);




          $rows++;
      }

      $writer = new Xlsx($spreadsheet);
      $fileName= APPPATH."excel/".$filename;
		
      $writer->save($fileName); // untuk menyimpan ke direktory tertentu
      header("Content-Type: application/vnd.ms-excel");
      // header('Content-Disposition: attachment;filename="Data.xls"');
     // $writer->save('php://output');
       $filepath = file_get_contents($fileName);
      force_download($fileName,null);
      //redirect(base_url()."/upload/".$fileName); 
 
	}
}