<?php


	class naive_bayes
	{
		
		function __construct($data, $kata, $label, $data_testing, $label_testing)
		{
			$this->do($data, $kata, $label, $data_testing, $label_testing);
		}

		public function do($cleaned, $new_kata, $new_label, $cleaned_testing, $label_testing){
	$mat_tf = [];
    $mat_df = [];
    for ($i=0; $i < count($new_kata); $i++) {
        $pos = 0;
        $neg = 0;
        $net = 0; 
        $mat_df[$i][0] = 0;
        $mat_df[$i][1] = 0;
        $mat_df[$i][2] = 0;
        for ($j=0; $j < count($cleaned); $j++) { 
             $er = explode(" ", $cleaned[$j]);
             if (in_array($new_kata[$i], $er)) {
                 if ($new_label[$j][0] == 0) {
                     
                     for ($k=0; $k < count($er); $k++) { 
                        if ($new_kata[$j] == $er[$k]) {
                     $net++;    
                        }
                     }
                     $mat_df[$i][0]++;
                 }
                 elseif ($new_label[$j][0] == 1) {
                     
                     for ($k=0; $k < count($er); $k++) { 
                        if ($new_kata[$j] == $er[$k]) {
                     $pos++;    
                        }
                     }

                     $mat_df[$i][1]++;
                 }

                 elseif ($new_label[$j][0] == 2) {
                     $neg++;
                     
                     for ($k=0; $k < count($er); $k++) { 
                        if ($new_kata[$j] == $er[$k]) {
                     $neg++;    
                        }
                     }

                     $mat_df[$i][2]++;
                 }
             }
        }
    $mat_tf[$i][0] = $net;
    $mat_tf[$i][1] = $pos;
    $mat_tf[$i][2] = $neg;
    }

    $mat_idf = [];
    for ($i=0; $i < count($new_kata); $i++) {
      if ($mat_df[$i][0] != 0) {
          $mat_idf[$i][0] = log(count($cleaned)/$mat_df[$i][0], 10); 
      }
      else{
        $mat_idf[$i][0] = 0; 
      }
      
      if ($mat_df[$i][1] != 0) {
          $mat_idf[$i][1] = log(count($cleaned)/$mat_df[$i][1], 10); 
      }
      else{
        $mat_idf[$i][1] = 0; 
      }

      if ($mat_df[$i][2] != 0) {
          $mat_idf[$i][2] = log(count($cleaned)/$mat_df[$i][2], 10); 
      }
      else{
        $mat_idf[$i][2] = 0; 
      }
    }


    $mat_tf_idf = [];


    for ($i=0; $i < count($new_kata); $i++) { 
       $mat_tf_idf[$i][0] = $mat_tf[$i][0] * $mat_idf[$i][0];
       $mat_tf_idf[$i][1] = $mat_tf[$i][1] * $mat_idf[$i][1];
       $mat_tf_idf[$i][2] = $mat_tf[$i][2] * $mat_idf[$i][2];
    }



    //print_r($mat_tf_idf);
    //echo "<br>";

    $tot_0 = 0;
    $tot_1 = 0;
    $tot_2 = 0;
    for ($i=0; $i < count($mat_tf); $i++) { 
        $tot_0 += $mat_tf_idf[$i][0];
        $tot_1 += $mat_tf_idf[$i][1];
        $tot_2 += $mat_tf_idf[$i][2];
    }

    $total_real = $tot_0+$tot_1+$tot_2;
    


    $prob = [];

    for ($i=0; $i < count($mat_tf); $i++) { 
        $prob[$i][0] = (1+$mat_tf_idf[$i][0])/($tot_0 + $total_real);
        $prob[$i][1] = (1+$mat_tf_idf[$i][1])/($tot_1 + $total_real);
        $prob[$i][2] = (1+$mat_tf_idf[$i][2])/($tot_2 + $total_real);
    }

    //print_r($prob);
    //echo "<br>";

    // // $testing = "alhamdulillah setelah vaksin tubuh jadi sehat";

    // // $er = explode(" ", $testing);
    // // $temp = [];
    // // for ($i=0; $i < count($new_kata); $i++) { 
    // //     if (in_array($new_kata[$i], $er)) {
    // //         $temp[] = $i;
    // //     }
    // // }

    // // $final = [];
    // // $final[0][0] = 0.3333;
    // // $final[0][1] = 0.3333;
    // // $final[0][2] = 0.3333;
    // // for ($i=0; $i < count($temp); $i++) { 
    // //        $final[0][0] *= $prob[$temp[$i]][0];
    // //        $final[0][1] *= $prob[$temp[$i]][1];
    // //        $final[0][1] *= $prob[$temp[$i]][2];  
    // //     }
    // // print_r($final);    


    // $data_testing= $this->model->getData($this->file2);
    //print_r($data_train);

    // $new_data_testing = [];
    // $r = 0;
    // for ($i=0; $i < 50; $i++) { 
    //   $new_data_testing[$r] = $data_testing[$i][0];
    //   //$new_data[$r][1] = $data[$i][5];
    //   $r++;
    // }

    //  $pra = [];
    //  for ($i=0; $i < count($new_data_testing); $i++) { 
    //  $cleaned = preg_replace("/@([a-zA-Z0-9_]+)/", "", $new_data_testing[$i]);
    //  $cleaned = preg_replace("/#([a-zA-Z0-9_]+)/", "", $cleaned);
    //  $cleaned = preg_replace('#\b(?:https?://|www\.)\S+\b#', '', $cleaned);
    //  $cleaned = preg_replace("/[[:punct:]]/", "", $cleaned);
    //  $cleaned = preg_replace('/[0-9]+/', '', $cleaned);
    //  $pra[$i] = $cleaned;
    //  }
    // $cleaned_testing = $this->model->praProses($pra);

    // $label_testing              = $this->model->getData($this->file3);
    //print_r($label_testing);
    $new_label_testing = [];
    $p = 0;
    for ($i=0; $i < 50; $i++) { 
        $new_label_testing[$p] = $label_testing[$i][0];
        $p++;
    }
    

    $finale = [];
    for ($j=0; $j < count($cleaned_testing); $j++) { 
    $er = explode(" ", $cleaned_testing[$j]);
    $temp = [];
    for ($i=0; $i < count($new_kata); $i++) { 
        if (in_array($new_kata[$i], $er)) {
            $temp[] = $i;
        }
    }
    $finale[] = $temp;
    }
    //print_r($finale);
    //echo "<br>";
    $final = [];
    $final[0][0] = 0.3333;
    $final[0][1] = 0.3333;
    $final[0][2] = 0.3333;
    
    for ($i=0; $i < count($cleaned_testing); $i++) { 
        $final[$i][0] = 0.3333;
        $final[$i][1] = 0.3333;
        $final[$i][2] = 0.3333;    
    }

    

    for ($j=0; $j < count($cleaned_testing); $j++) { 
    for ($i=0; $i < count($finale[$j]); $i++) { 
           $final[$j][0] *= $prob[$finale[$j][$i]][0];
           $final[$j][1] *= $prob[$finale[$j][$i]][1];
           $final[$j][2] *= $prob[$finale[$j][$i]][2]; 
        }
    }

    //print_r($final);
    //echo "<br>";
    //print_r($final);
    
    for ($i=0; $i < count($final); $i++) { 
        for ($j=0; $j < count($final[0]); $j++) { 
             $final[$i][$j] = number_format($final[$i][$j], 20);
        }
    }



    // //print_r($new_kata);

    $max = [];
    for ($i=0; $i < count($final); $i++) { 
          $max[] = max($final[$i]);
    }
    // print_r($max);
    $t = [];
    for ($i=0; $i < count($max); $i++) { 
        $t[] = array_search($max[$i], $final[$i]);
    }
    
    // // echo "<br>";
    // // echo "<br>";
    //print_r($t);
    $sum = 0;
    for ($i=0; $i < count($t); $i++) { 
       if ($t[$i] == $new_label_testing[$i]) {
        $sum++;
       }
    }

    $cf = [];
    $cf[0][0] = 0;
    $cf[0][1] = 0;
    $cf[0][2] = 0;
    $cf[1][0] = 0;
    $cf[1][1] = 0;
    $cf[1][2] = 0;
    $cf[2][0] = 0;
    $cf[2][1] = 0;
    $cf[2][2] = 0;
    for ($i=0; $i < count($t); $i++) { 
       if ($t[$i] == 0 &&  $new_label_testing[$i] == 0) {
          $cf[0][0] += 1;
       }
       elseif ($t[$i] == 0 &&  $new_label_testing[$i] == 1) {
         $cf[0][1] += 1;
       }
       elseif ($t[$i] == 0 &&  $new_label_testing[$i] == 2) {
         $cf[0][2] += 1;
       }
       elseif ($t[$i] == 1 &&  $new_label_testing[$i] == 0) {
         $cf[1][0] += 1;
       }
       elseif ($t[$i] == 1 &&  $new_label_testing[$i] == 1) {
         $cf[1][1] += 1;
       }
       elseif ($t[$i] == 1 &&  $new_label_testing[$i] == 2) {
         $cf[1][2] += 1;
       }
       elseif ($t[$i] == 2 &&  $new_label_testing[$i] == 0) {
         $cf[2][0] += 1;
       }
       elseif ($t[$i] == 2 &&  $new_label_testing[$i] == 1) {
         $cf[2][1] += 1;
       }
       elseif ($t[$i] == 2 &&  $new_label_testing[$i] == 2) {
         $cf[2][2] += 1;
       }
    }
    //print_r($cf);
    // echo "<br>";
    // print_r($t);
    // echo "<br>";
    // print_r($new_label_testing);
    $akurasi = $sum/count($t);
    // echo $akurasi;
    // echo "<br>";
    $this->cf = $cf;
    $this->index = $t;
    $this->akurasi = $akurasi;
		}
	}

?>