
<?php
    require 'connection.php';

    $tmpName = $_FILES['datafile1']['tmp_name'];
    $csvAsArray = array_map( function($d) {return str_getcsv($d, "\t"); }, file($tmpName));

    $lectures = array_slice($csvAsArray,7);
    array_pop($lectures);

    foreach ($lectures as $value) {
      $error = $value[0];
      $utcoffset = $value[1];
      $lecturetimestamp = $value[2];
      $frecuency = $value[3];
      $currentA = $value[4];
      $currentB = $value[5];
      $currentC = $value[6];
      $currentM = $value[7];
      $voltageAB = $value[8];
      $voltageBC = $value[9];
      $voltageCA = $value[10];
      $powerFactor = $value[11];
      $activepower = $value[12];
      $reactivepower = $value[13];
      $activeenergydelivered = $value[14];
      $reactiveenergydelivered = $value[15];
      $demandactivepower = $value[16];
      $demandreactivepower = $value[17];

      $sql = "INSERT INTO lectures (error,utcoffset,lecturetimestamp,frecuency,currentA,currentB,currentC,currentN,voltageAB,voltageBC,voltageCA,powerFactor,activepower,reactivepower,activeenergydelivered,reactiveenergydelivered,demandactivepower,demandreactivepower)
      VALUES ($error, $utcoffset,'$lecturetimestamp',0,$currentA,$currentB,$currentC,$currentM,$voltageAB,$voltageBC,$voltageCA,0,$activepower,$reactivepower,$activeenergydelivered,$reactiveenergydelivered,0,0)";

      if (mysqli_query($conn, $sql)) {
          echo "New record created successfully <br>";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }

?>
