
<?php
    require 'connection.php';


    //file_put_contents("lastpost.txt", $entityBody);
    //$tmpName = $_FILES['csv']['tmp_name'];

    $csvData = file_get_contents('php://input');
    $lines = explode(PHP_EOL, $csvData);
    $array = array();
    foreach ($lines as $line) {
        $array[] = str_getcsv($line,"\t");
    }

    $lectures = array_slice($array,7);
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
