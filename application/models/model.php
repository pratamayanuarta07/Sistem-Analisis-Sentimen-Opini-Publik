<?php
defined('BASEPATH') or exit('No direct script access allowed');
//ini_set('memory_limit', '512M');
ini_set('memory_limit', '1024M');
ini_set('max_execution_time', '1000');

function format($val, $point)
{
  return number_format((float)$val, $point, '.', '');
}

class model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->KAMUS_NORMALIZE  = 'kamus/bakutidakbaku.txt';
    $this->KAMUS_STOPWORDS  = 'kamus/stopwords.txt';
    $this->KAMUS_KATA_DASAR = 'kamus/katadasar.txt';
  }
  public function praProses($data)
  {
    // PRAPROSES
    
    //$data = $this->noiseRemoval($data);
    
    $data = $this->stopwords($data);
    $data = $this->normalize($data);
    $data = $this->caseFolding($data);
    //$data = $this->stemming($data);
    return $data;
  }

  public function caseFolding($kalimat)
  {
    for ($i = 0; $i < count($kalimat); $i++) {
      $kalimat[$i] = strtolower($kalimat[$i]);
    }
    return $kalimat;
  }
  public function normalize($kalimat)
  {
    // INIT KAMUS NORMALIZE
    $raw       = $this->getFile($this->KAMUS_NORMALIZE);
    $normalize = [];
    $tidakBaku = [];
    $baku      = [];

    for ($i = 0; $i < count($raw); $i++) {
      $normalize[$i] = explode(" ", $raw[$i]);
      $tidakBaku[$i] = $normalize[$i][0];
      $baku[$i]      = $normalize[$i][1];
    }
    // LOOP ARRAY KALIMAT
    for ($i = 0; $i < count($kalimat); $i++) {
      // UBAH KALIMAT JADI ARRAY KATA
      $kata   = explode(" ", $kalimat[$i]);

      for ($j = 0; $j < count($kata); $j++) {
        // JIKA ADA KATA PADA KAMUS TIDAK BAKU, MAKA UBAH JADI KATA BAKU
        if (in_array($kata[$j], $tidakBaku)) {
          $key = array_search($kata[$j], $tidakBaku);
          $kata[$j] = $baku[$key];
        }
      }
      // GABUNGIN JADI STRING KALIMAT LAGI
      $kalimat[$i] = implode(" ", $kata);
    }
    return $kalimat;
  }
  public function noiseRemoval($kalimat)
  {
    //echo count($kalimat);
    for ($i = 1; $i < 298; $i++) {
      $kalimat[$i]   = preg_replace("/@([a-zA-Z0-9_]+)/", "", $kalimat[$i]);
      $kalimat[$i] = preg_replace('#\b(?:https?://|www\.)\S+\b#', '', $kalimat[$i]);
      $kalimat[$i] = preg_replace("/[[:punct:]]/", "", $kalimat[$i]);
      //$kalimat[$i] = preg_replace('/[0-9]+/', '', $kalimat[$i]);
    }
    return $kalimat;
  }

  public function stopwords($kalimat)
  {
    // INIT KAMUS STOPWORDS
    $stopwords = $this->getFile($this->KAMUS_STOPWORDS);
    // LOOP ARRAY KALIMAT
    for ($i = 0; $i < count($kalimat); $i++) {
      // UBAH KALIMAT JADI ARRAY KATA
      $kata   = explode(" ", $kalimat[$i]);
      $delete = [];


      for ($j = 0; $j < count($kata); $j++) {
        // JIKA ADA KATA PADA STOPWORDS, MAKA SIMPAN DI ARRAY DELETE
      //   if (strpos("@", $kata[$j])) {
      //       $delete[] = $kata[$j];
      // }
        if (in_array($kata[$j], $stopwords))
          $delete[] = $kata[$j];
      }
      // DELETE KATA SESUAI ISI ARRAY DELETE
      $kata        = \array_diff($kata, $delete);
      $kalimat[$i] = implode(" ", $kata);
    }
    //echo '<pre>';
    //print_r($kalimat);
    //echo '</pre>';
    return $kalimat;
  }

  public function stemming($kalimat)
  {
    // INIT LIBRARY STEMMING
    $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
    $stemmer        = $stemmerFactory->createStemmer();
    // LOOP SETIAP ARRAY KALIMAT, LAKUKAN STEMMING
    for ($i = 0; $i < count($kalimat); $i++) {
      $stem[$i] = $stemmer->stem($kalimat[$i]);
    }
    return $stem;
  }


    public function getData($filename){
		$data    = [];
		$file    = fopen(base_url()."assets/$filename","r");
		$count   = 0;

		while(! feof($file)){
			$data[$count] = fgetcsv($file);
			$count++;
		}
		fclose($file);
		return $data;
  }
  public function getFile($filepath)
  {
    $file = base_url() . "assets/$filepath";
    $raw  = explode(PHP_EOL, file_get_contents($file));
    return $raw;
  }
  // UNTUK BUKA FILE TAB SEPARATED
  public function getTsv($filename)
  {
    // READ FILE
    $raw = $this->getFile($filename);
    // SPLIT DENGAN TAB
    for ($i = 0; $i < count($raw); $i++) {
      $hasil[] = explode("\t", $raw[$i]);
    }
    return $hasil;
  }
  
  
  
  
}

/* End of file M_dashboard.php */
/* Location: ./application/models/M_dashboard.php */