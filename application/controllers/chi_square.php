<?php


	class chi_square
	{
		
		function __construct($data, $kata, $label)
		{
			$this->do($data, $kata, $label);
		}

		public function do($cleaned, $kata, $new_label){
	$mat_0 = [];
    for ($i=0; $i < count($kata); $i++) { 
      $AA = 0;
      $AC = 0;
      $AB = 0;
      $AD = 0; 
      for ($j=0; $j < count($cleaned); $j++) { 
        $er = explode(" ", $cleaned[$j]);
        if ($new_label[$j][0] == 0) {
          if (in_array($kata[$i], $er)) {
            $AA++;
          }
          else{
           $AC++;
          }
        }
        else{
          if (in_array($kata[$i], $er)) {
            $AB++;
          }
          else{
           $AD++;
          }
        }  
       }
      $mat_0[$i][0] = $AA;
      $mat_0[$i][2] = $AC;
      $mat_0[$i][1] = $AB;
      $mat_0[$i][3] = $AD;
    }

    $mat_1 = [];
    for ($i=0; $i < count($kata); $i++) { 
      $AA = 0;
      $AC = 0;
      $AB = 0;
      $AD = 0; 
      for ($j=0; $j < count($cleaned); $j++) { 
        $er = explode(" ", $cleaned[$j]);
        if ($new_label[$j][0] == 1) {
          if (in_array($kata[$i], $er)) {
            $AA++;
          }
          else{
           $AC++;
          }
        }
        else{
          if (in_array($kata[$i], $er)) {
            $AB++;
          }
          else{
           $AD++;
          }
        }  
       }
      $mat_1[$i][0] = $AA;
      $mat_1[$i][2] = $AC;
      $mat_1[$i][1] = $AB;
      $mat_1[$i][3] = $AD;
    }

    $mat_2 = [];
    for ($i=0; $i < count($kata); $i++) { 
      $AA = 0;
      $AC = 0;
      $AB = 0;
      $AD = 0; 
      for ($j=0; $j < count($cleaned); $j++) { 
        $er = explode(" ", $cleaned[$j]);
        if ($new_label[$j][0] == 2) {
          if (in_array($kata[$i], $er)) {
            $AA++;
          }
          else{
           $AC++;
          }
        }
        else{
          if (in_array($kata[$i], $er)) {
            $AB++;
          }
          else{
           $AD++;
          }
        }  
       }
      $mat_2[$i][0] = $AA;
      $mat_2[$i][2] = $AC;
      $mat_2[$i][1] = $AB;
      $mat_2[$i][3] = $AD;
    }


    //print_r($mat_0);
    //print_r($mat_1);
    //print_r($mat_2);
    $chi_0 = [];
    for ($i=0; $i < count($kata); $i++) { 
      $chi_0[$i] = (count($cleaned)*pow((($mat_0[$i][0]*$mat_0[$i][3])-($mat_0[$i][2]*$mat_0[$i][1])), 2))/(($mat_0[$i][0]+$mat_0[$i][2])*($mat_0[$i][1]+$mat_0[$i][3])*($mat_0[$i][0]+$mat_0[$i][1])*($mat_0[$i][2]+$mat_0[$i][3]));
    }

    $chi_1 = [];
    for ($i=0; $i < count($kata); $i++) { 
      $chi_1[$i] = (count($cleaned)*pow((($mat_1[$i][0]*$mat_1[$i][3])-($mat_1[$i][2]*$mat_1[$i][1])), 2))/(($mat_1[$i][0]+$mat_1[$i][2])*($mat_1[$i][1]+$mat_1[$i][3])*($mat_1[$i][0]+$mat_1[$i][1])*($mat_1[$i][2]+$mat_1[$i][3]));
    }

    $chi_2 = [];
    for ($i=0; $i < count($kata); $i++) { 
      $chi_2[$i] = (count($cleaned)*pow((($mat_2[$i][0]*$mat_2[$i][3])-($mat_2[$i][2]*$mat_2[$i][1])), 2))/(($mat_2[$i][0]+$mat_2[$i][2])*($mat_2[$i][1]+$mat_2[$i][3])*($mat_2[$i][0]+$mat_2[$i][1])*($mat_2[$i][2]+$mat_2[$i][3]));
    }
    //print_r($chi_0);
    //print_r($chi_1);
    //print_r($chi_2);
    $max = [];
    for ($i=0; $i < count($chi_0); $i++) { 
      $temp = [];
      $temp[0] = $chi_0[$i];
      $temp[1] = $chi_1[$i];
      $temp[2] = $chi_2[$i];
      $max[] = max($temp);
    }
    //print_r($max);
    $count = [];
    for ($i=0; $i < count($max); $i++) { 
       if ($max[$i] < 1.3) {
         $count[] = $i;
       }
    }
    //print_r($count);
    
    

    $new_kata = [];
    $index = 0;
    for ($i=0; $i < count($kata); $i++) { 
        if (!in_array($i, $count)) {
            $new_kata[$index] = $kata[$i];
            $index++;
        }
    }


    $this->new_kata = $new_kata;

		}
	}

?>