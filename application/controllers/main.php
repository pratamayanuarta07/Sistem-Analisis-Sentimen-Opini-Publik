<?php
defined('BASEPATH') or exit('No direct script access allowed');
include ('chi_square.php');
include ('naive_bayes.php');
class main extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('model');
    $this->file='data_training.csv';
    $this->file1='label_training.csv';
    $this->file2='data_testing.csv';
    $this->file3='label_testing.csv';
  }

  public function index()
  {
    $data               = $this->model->getData($this->file);
    $label              = $this->model->getData($this->file1);
    //$data['data']       = $data;
    $new_data = [];
    $r = 0;
    for ($i=1; $i < 145; $i++) { 
      $new_data[$r] = $data[$i][0];
      //$new_data[$r][1] = $data[$i][5];
      $r++;
    }
    $new_label = [];
    $p = 0;
    for ($i=1; $i < 145; $i++) { 
        $new_label[$p] = $label[$i];
        $p++;
    }
    //print_r($label);
     $pre = [];
     for ($i=0; $i < count($new_data); $i++) { 
     $cleaned = preg_replace("/@([a-zA-Z0-9_]+)/", "", $new_data[$i]);
     $cleaned = preg_replace("/#([a-zA-Z0-9_]+)/", "", $cleaned);
     $cleaned = preg_replace('#\b(?:https?://|www\.)\S+\b#', '', $cleaned);
     $cleaned = preg_replace("/[[:punct:]]/", "", $cleaned);
     $cleaned = preg_replace('/[0-9]+/', '', $cleaned);
     $pre[$i] = $cleaned;
     }
    $cleaned_train = $this->model->praProses($pre);//model    
    //print_r($cleaned_train);
    $data_testing= $this->model->getData($this->file2);
    //print_r($data_testing);

    $new_data_testing = [];
    $r = 0;
    for ($i=0; $i < 50; $i++) { 
      $new_data_testing[$r] = $data_testing[$i][0];
      //$new_data[$r][1] = $data[$i][5];
      $r++;
    }

     $pra = [];
     for ($i=0; $i < count($new_data_testing); $i++) { 
     $cleaned = preg_replace("/@([a-zA-Z0-9_]+)/", "", $new_data_testing[$i]);
     $cleaned = preg_replace("/#([a-zA-Z0-9_]+)/", "", $cleaned);
     $cleaned = preg_replace('#\b(?:https?://|www\.)\S+\b#', '', $cleaned);
     $cleaned = preg_replace("/[[:punct:]]/", "", $cleaned);
     $cleaned = preg_replace('/[0-9]+/', '', $cleaned);
     $pra[$i] = $cleaned;
     }
    $cleaned_testing = $this->model->praProses($pra);

    $label_testing              = $this->model->getData($this->file3);
    //print_r($cleaned_testing);
    $new_label_testing = [];
    $p = 0;
    for ($i=0; $i < 50; $i++) { 
        $new_label_testing[$p] = $label_testing[$i][0];
        $p++;
    }

    //print_r($new_label);
    //print_r($new_label_testing);
    $data['data_train']               = $cleaned_train;
    $data['data_testing']             = $cleaned_testing;
    $data['label_train']              = $new_label;
    $data['label_testing']            = $new_label_testing;
    
    $this->load->view('layout/header');
    $this->load->view('layout/navbar');
    $this->load->view('dashboard/hasil',$data);
    $this->load->view('layout/footer');
    $this->load->view('dashboard/Hasil_js');
  }

  public function predict()
  {
    $data               = $this->model->getData($this->file);
    $label              = $this->model->getData($this->file1);
    //$data['data']       = $data;
    $new_data = [];
    $r = 0;
    for ($i=1; $i < 145; $i++) { 
      $new_data[$r] = $data[$i][0];
      //$new_data[$r][1] = $data[$i][5];
      $r++;
    }
    $new_label = [];
    $p = 0;
    for ($i=1; $i < 145; $i++) { 
        $new_label[$p] = $label[$i];
        $p++;
    }
    //print_r($new_data);
     $pre = [];
     for ($i=0; $i < count($new_data); $i++) { 
     $cleaned = preg_replace("/@([a-zA-Z0-9_]+)/", "", $new_data[$i]);
     $cleaned = preg_replace("/#([a-zA-Z0-9_]+)/", "", $cleaned);
     $cleaned = preg_replace('#\b(?:https?://|www\.)\S+\b#', '', $cleaned);
     $cleaned = preg_replace("/[[:punct:]]/", "", $cleaned);
     $cleaned = preg_replace('/[0-9]+/', '', $cleaned);
     $pre[$i] = $cleaned;
     }
     
    // echo $cleaned;
    $cleaned = $this->model->praProses($pre);
    $bersih = $cleaned;
    //print_r($pre);
    //print_r($new_label);
    // $newstring = preg_replace("/[^A-Za-z]+/i", " ", $cleaned[1]);
    // //echo $newstring;
    // $ert = explode(" ", $cleaned[1]);
    // print_r($new_data);


    $kata = [];
    $o = 0;
    $et = 0;
    for ($i=0; $i < count($cleaned); $i++) { 
      $er = explode(" ", $cleaned[$i]);
      for ($j=0; $j < count($er); $j++) { 
         if ($o == 0) {
            $kata[$et] = $er[$j];
            $o++;
            $et++;
         }
         else{
           if (!in_array($er[$j], $kata)) {
             $kata[$et] = $er[$j];
             $et++;
           }
         }
      }
    }


    $data_testing = $this->model->getData($this->file2);

    $new_data_testing = [];
    $r = 0;
    for ($i=0; $i < 50; $i++) { 
      $new_data_testing[$r] = $data_testing[$i][0];
      //$new_data[$r][1] = $data[$i][5];
      $r++;
    }

     $pra = [];
     for ($i=0; $i < count($new_data_testing); $i++) { 
     $cleaned1 = preg_replace("/@([a-zA-Z0-9_]+)/", "", $new_data_testing[$i]);
     $cleaned1 = preg_replace("/#([a-zA-Z0-9_]+)/", "", $cleaned1);
     $cleaned1 = preg_replace('#\b(?:https?://|www\.)\S+\b#', '', $cleaned1);
     $cleaned1 = preg_replace("/[[:punct:]]/", "", $cleaned1);
     $cleaned1 = preg_replace('/[0-9]+/', '', $cleaned1);
     $pra[$i] = $cleaned1;
     }

    $cleaned_testing = $this->model->praProses($pra);

    $label_testing = $this->model->getData($this->file3);

    $new_label_testing = [];
    $p = 0;
    for ($i=0; $i < 50; $i++) { 
        $new_label_testing[$p] = $label_testing[$i][0];
        $p++;
    }

    //print_r($kata);
    $kata2 = $kata;
    //print_r($kata2);
    $chi = new chi_square($cleaned, $kata, $new_label);
    $new_kata = $chi->new_kata;
    //print_r($new_kata);
    $naive = new naive_bayes($cleaned, $kata, $new_label, $cleaned_testing, $label_testing);
    $akurasi_tanpa = $naive->akurasi;
    $t = $naive->index;
    $naive_dengan = new naive_bayes($cleaned, $new_kata, $new_label, $cleaned_testing, $label_testing);
    $akurasi = $naive_dengan->akurasi;
    $t1 = $naive_dengan->index;
    //print_r($t1);
    
    $new_label_testing_prediksi_tanpa = [];
    for ($i=0; $i < count($t); $i++) { 
       if ($t[$i] == 0) {
          $new_label_testing_prediksi[$i] = "Netral";
       }
       elseif ($t[$i] == 1) {
          $new_label_testing_prediksi[$i] = "Positif";
       }
       else{
        $new_label_testing_prediksi[$i] = "Negatif";
       }
    }

    $new_label_testing_prediksi_dengan = [];
    for ($i=0; $i < count($t); $i++) { 
       if ($t1[$i] == 0) {
          $new_label_testing_prediksi_dengan[$i] = "Netral";
       }
       elseif ($t1[$i] == 1) {
          $new_label_testing_prediksi_dengan[$i] = "Positif";
       }
       else{
        $new_label_testing_prediksi_dengan[$i] = "Negatif";
       }
    }

    $new_label_testing_aktual = [];
    for ($i=0; $i < count($t); $i++) { 
       if ($new_label_testing[$i] == 0) {
          $new_label_testing_aktual[$i] = "Netral";
       }
       elseif ($new_label_testing[$i] == 1) {
          $new_label_testing_aktual[$i] = "Positif";
       }
       else{
        $new_label_testing_aktual[$i] = "Negatif";
       }
    }

    // //print_r($new_kata);
    $data['data']                     = $cleaned_testing;
    $data['label_prediksi_tanpa']     = $new_label_testing_prediksi;
    $data['label_aktual']             = $new_label_testing_aktual;
    $data['akurasi_tanpa']            = round($akurasi_tanpa*100);
    $data['label_prediksi']           = $new_label_testing_prediksi_dengan;
    $data['akurasi']                  = round($akurasi*100);
    $data['cf_dengan']                = $naive_dengan->cf;
    $data['cf_tanpa']                 = $naive->cf;

    $this->load->view('layout/header');
    $this->load->view('layout/navbar');
    $this->load->view('dashboard/hasil2',$data);
    $this->load->view('layout/footer');
    $this->load->view('dashboard/Hasil_js');
  }
}

/* End of file Dasboard.php */
/* Location: ./application/controllers/Dasboard.php */