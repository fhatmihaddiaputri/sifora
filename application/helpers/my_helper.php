<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if ( ! function_exists('random')){
   function random(){
         $number = rand(1111,9999);
         return $number;
       }
   }
 
if ( ! function_exists('current_utc_date_time')){
   function current_utc_date_time(){
         $dateTime = gmdate("Y-m-d\TH:i:s\Z");;
         return $dateTime;
       }
   }   

if ( ! function_exists('dateformat')){
   function dateformat($date){
     $newDate = date("d-m-Y", strtotime($date));  
        // $dateTime = gmdate("Y-m-d\TH:i:s\Z");;
         return $newDate;
       }
   } 



 if ( ! function_exists('random_strings')){

function random_strings($length_of_string) { 
    return substr(md5(time()), 0, $length_of_string); 
} 
}




if ( ! function_exists('convRupiah')){

    function convRupiah($value) {
     // return 'Rp ' . number_format($value).',-';
      return 'Rp ' . number_format($value,0,',','.').',-';
    } 
}  
if ( ! function_exists('penyebut')){
function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
      $temp = penyebut($nilai - 10). " belas";
    } else if ($nilai < 100) {
      $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
      $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
  }
 }
if ( ! function_exists('terbilang')){

  function terbilang($nilai) {
    if($nilai<0) {
      $hasil = "minus ". trim(penyebut($nilai));
    } else {
      $hasil = trim(penyebut($nilai));
    }         
    return $hasil;
  }
}