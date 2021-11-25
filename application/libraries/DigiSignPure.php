<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
Last Update : 3 Agustus 2020
Location    : Jogjakarta
Changes     :
	+ deteksi otomatis page orientation
	+ tambah fungsi tanpa QR Code 

	Pake nya
	// load library digital signature
	$this->load->library('DigiSign');
	
	// reset passphrase pegawai, argumen NIP
	$this->digisign->reset_passphrase($nip);
	
	// mendaftarkan Pegawai untuk mendapatkan sertifikat TTE, argumen NIP dan Dokumen Rekomendasi
	$this->digisign->do_register($nip, '/var/www/dokumen.pdf');

	// melihat status TTE Pegawai, argumen NIP
	$this->digisign->check_status($nip);

	// melakukan tandatangan elektronik
	// full properties dengan keterangan footer
	$this->digisign->sign_doc($nip, $passphrase, $dokumen_path, array('qrdata'=>base_url('digisign/blabla'),
																		'namalengkap'=>'Zeno Dani K',
																		'namapn'=>'Pengadilan Negeri XXXXXXXX',
																		'jabatan'=>'Panitera',
																		'reason'=>'Tandatangan Salinan Putusan',
																		'location'=>'Lokasi Penandatanganan',
																		'text'=>'Tambahan Text'),
																'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
										);
	// full properties tanpa keterangan footer
	$this->digisign->sign_doc($nip, $passphrase, $dokumen_path, array('qrdata'=>base_url('digisign/blabla'),
																		'namalengkap'=>'Zeno Dani K',
																		'namapn'=>'Pengadilan Negeri XXXXXXXX',
																		'jabatan'=>'Panitera',
																		'reason'=>'Tandatangan Salinan Putusan',
																		'location'=>'Lokasi Penandatanganan',
																		'text'=>'Tambahan Text') );
	// tanpa QR Code dan informasi Footer
	$this->digisign->sign_doc($nip, $passphrase, $dokumen_path);

	// lupa passphrase dan reset, argumen NIP
	$this->digisign->reset_passphrase($nip);

	// verifikasi dokumen dan melihat properties dokumen, argumen Dokumen yang akan di cek.
	$this->digisign->verify_doc($dokumen_path);
*/

//include_once ('digisign/DigisignRest.php');

class DigiSignPure {
	protected $base_digisign = 'https://apids.mahkamahagung.go.id';
	protected $digisign_url = 'https://apids.mahkamahagung.go.id';
	protected $apikey = '';
	protected $devmode = false;


	public function __construct(){
		if($this->devmode){
			$this->digisign_url = $this->base_digisign."/Dev/index_post";
		}else{
			$this->digisign_url = $this->base_digisign."/Read/index_post";
		}
    }

    public function setAPImode($flag){
    	if(strtolower($flag)=='dev'){
    		$this->devmode = true;
			$this->digisign_url = $this->base_digisign."/Dev/index_post";
		}else{
			$this->devmode = false;
			$this->digisign_url = $this->base_digisign."/Read/index_post";
		}
    }

    public function getAPImode(){
    	if($this->devmode){
    		return "development";
		}else{
			return "production";
		}
    }
    
    // FUNGSI UTAMA CLASS DIGISIGN 

    /*
	FUNGSI PENGIRIMAN DATA KE API MENGGUNAKAN CURL

    */
    public function send($url, $method, $queryData = null, array $files = null)
    {
        $curl = curl_init();

        if(!is_null($queryData)) $content = http_build_query($queryData);
        else $content = '';

        if(!is_null($files)) {
            $postfields = $this->curl_custom_postfields($files, $queryData);
            $header = $postfields[0];
            $body = $postfields[1];
        }else {
            $header = '';
            $body = $content;
        }
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url . '?' . $content,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "utf_8",
			CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 3600,
			CURLOPT_CONNECTTIMEOUT => 3600,
			CURLOPT_DNS_CACHE_TIMEOUT => 3600,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_NOBODY => false,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => array(
                'cache-control: no-cache',
                $header
            ),
        ));
        
        $response = curl_exec($curl);
        $x = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
		} else {
		$res = json_decode($response);

		
		if(json_last_error() == JSON_ERROR_NONE) {
		    if(isset($res->error)){
		        $this->error = $res->error;
		        return false;
		    }else return $res;
		}else{ 
		    return $response;
		}
		}
  
    }

    /*
	FUNGSI MEMBUAT CUSTOM FIELD UNTUK POST CONTENT CURL

    */
    private function curl_custom_postfields(array $files = array(), $queryData = array()) {
   
        // invalid characters for "name" and "filename"
        static $disallow = array("\0", "\"", "\r", "\n");
       
        // build file parameters
        foreach ($files as $k => $v) {
            switch (true) {
                case false === $v = realpath(filter_var($v)):
                case !is_file($v):
                case !is_readable($v):
                    continue; // or return false, throw new InvalidArgumentException
            }
            $data = file_get_contents($v);
            //$v = call_user_func("end", explode(DIRECTORY_SEPARATOR, $v));
            $k = str_replace($disallow, "_", $k);
            $v = str_replace($disallow, "_", $v);
            $name = basename($v);
            $type = mime_content_type($v);
            $body[] = implode("\r\n", array(
                "Content-Disposition: form-data; name=\"{$k}\"; filename=\"{$name}\"",
                "Content-Type: " . $type,
                "",
                $data,
            ));
        }
        
        foreach ($queryData as $key => $value) {
            $body[] = "Content-Disposition: form-data; name=\"{$key}\"; \r\n\r\n{$value}";
        }
       
        // generate safe boundary
        do {
            $boundary = "---------------------" . md5(mt_rand() . microtime());
        } while (preg_grep("/{$boundary}/", $body));
       
        // add boundary for each parameters
        array_walk($body, function (&$part) use ($boundary) {
            $part = "--{$boundary}\r\n{$part}";
        });
       
        // add final boundary
        $body[] = "--{$boundary}--";
        $body[] = "";
       
        $header = "Content-Type: multipart/form-data; boundary={$boundary}";
        // set options
        return array($header, implode("\r\n", $body));
        
    }

    // END FUNGSI UTAMA

    /*
	FUNGSI CEK STATUS APAKAH NIP SUDAH TERDAFTAR DAN MEMILIKI SERTIFIKAT
	ARG : 
    	$nip = NIP Pendaftar (string)
    */
    public function check_status($nip){
    	if(trim($nip)==''){
			echo json_encode(array('st'=>0,'msg'=>'NIP Belum disertakan'));
			exit;
		}
    	$postdata = array('proses'=>'cekstatus',
    					'nip'=>$nip,);
        $response = $this->send($this->digisign_url, 'POST', $postdata);
    	return $response;
    }

    /*
    FUNGSI UNTUK MENANDATANGANI DOKUMEN PDF 
    ARG : 
    	$nip = NIP Pendaftar (string)
    	$passphrase = passphrase/pin 
    	$filepath   = absolute path file yang akan ditandatangani (string). ex. /tmp/198507222011011011/document.pdf
    	$info       = informasi pada signature dan barcode, meliputi :
    				qrdata   = Data yang akan ditanamkan ke dalam QR Code 
    				namalengkap  = Nama Lengkap Pejabat Penandatangan
    				namapn   = Nama Pengadilan Negeri Penandatangan
    				jabatan  = Jabatan Penandatangan
    				reason   = Alasan Penandatanganan
    				location = Tempat Penandatangan
    				text     = Teks tambahan
    	$notes      = Catatan Footer QR Code (tidak wajib)

    	**wajib
    	$doc_prop = properties document di repo
    	$doc_prop=array(
    		'document_owner_id' => 1-999
			'document_restricted' => 1
    	)
		
		**tidak wajib
    	$info=array(
			'qrdata' => '',
			'namalengkap' => '',
			'namapn' => '',
			'jabatan' => '',
			'reason' => '',
			'location' => '',
			'text' => '');
	*/

    public function sign_doc($nip, $passphrase, $filepath, $info=array(), $doc_prop){
    	if(trim($passphrase)==''){
			echo json_encode(array('st'=>0,'msg'=>'Passphrase Belum disertakan'));
			exit;
		}
    	if(trim($nip)==''){
			echo json_encode(array('st'=>0,'msg'=>'NIP Belum disertakan'));
			exit;
		}
		if(!is_readable($filepath)){
			echo json_encode(array('st'=>0,'msg'=>'Dokumen belum dilampirkan'));
			exit;
		}
		if (count($doc_prop) <= 0){
			echo json_encode(array('st'=>0,'msg'=>'Properti Dokumen yang akan ditandatangan belum ada. '.'<br>sign_doc($nip, $passphrase, $filepath, $info=array(), $doc_prop)'));
			exit;
		}

		$signinfo = $info;

		$postdata = array('proses'=>'sign');
		$postdata['nip'] = $nip;
		$postdata['passphrase'] = $passphrase;

		/* 
		properties dokumen di repo
			document_owner_id 	= 1:ecourt (referensi ada di DB repo)
			document_restricted = 0:public , 1:non-public

		tambahan informasi user-agent dan ip address
		*/
		
		$doc_prop['ipaddr']		=	$this->get_client_ip();
		if(isset($_SERVER['HTTP_USER_AGENT'])){
			$doc_prop['browser'] = $_SERVER['HTTP_USER_AGENT'];
		}
		$postdata['doc_prop'] = json_encode($doc_prop);

    	if(count($signinfo)>0){
    		$postdata['info'] = json_encode($signinfo);
    	}

    	$postfiles = array(
            'file' => $filepath
        );

		$response = $this->send($this->digisign_url, 'POST', $postdata, $postfiles);
		
    	return $response;
    	
    }

    /*
	Fungsi Ambil Data Pegawai

    */

    public function info_pegawai($nip){
    	$postdata = array('proses'=>'infoPegawai',
    					'nip' =>$nip,
    				);
        $response = $this->send($this->digisign_url, 'POST', $postdata);

    	return $response;
    }

    private function get_client_ip() {
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}

    /// fungsi yang belum tested dan working

    private function get_mime_type($file) {
		if (function_exists('finfo_open')) {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mimetype = finfo_file($finfo, $file);
			finfo_close($finfo);
		}else {
			$mimetype = mime_content_type($file);
		}
		if (empty($mimetype)) $mimetype = 'application/octet-stream';
		return $mimetype;
    }

    private function output_file($file){
	    if(!is_readable($file)){
	    	die('File not found or inaccessible!');
	    }
	    $size = filesize($file);
	    $name = rawurldecode(basename($file));

	    $mime_type = $this->get_mime_type($file);
	        
	    @ob_end_clean();
	    if(ini_get('zlib.output_compression')){
	    	ini_set('zlib.output_compression', 'Off');
		}
	    header('Content-Type: ' . $mime_type);
	    header('Content-Disposition: attachment; filename="'.$name.'"');
	    header("Content-Transfer-Encoding: binary");
	    header('Accept-Ranges: bytes');

	    if(isset($_SERVER['HTTP_RANGE'])){
	        list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
	        list($range) = explode(",",$range,2);
	        list($range, $range_end) = explode("-", $range);
	        $range=intval($range);
	        if(!$range_end){
	            $range_end=$size-1;
	        }else{
	            $range_end=intval($range_end);
	        }

	        $new_length = $range_end-$range+1;
	        header("HTTP/1.1 206 Partial Content");
	        header("Content-Length: $new_length");
	        header("Content-Range: bytes $range-$range_end/$size");
	    }else{
	        $new_length=$size;
	        header("Content-Length: ".$size);
	    }

	    $chunksize = 8*(1024*1024);
	    $bytes_send = 0;
	    if ($file = fopen($file, 'r')){
	        if(isset($_SERVER['HTTP_RANGE'])){
	        	fseek($file, $range);
	    	}
	        while(!feof($file) && (!connection_aborted()) && ($bytes_send<$new_length) ){
	            $buffer = fread($file, $chunksize);
	            echo($buffer);
	            flush();
	            $bytes_send += strlen($buffer);
	        }
	        fclose($file);
	    }else{
	        die('Error - can not open file.');
	    }
	    die();
	}

}