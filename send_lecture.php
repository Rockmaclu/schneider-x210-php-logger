
<?php
    require 'connection.php';
    $tmpName = $_FILES['csv']['tmp_name'];
    $csvAsArray = array_map('str_getcsv', file($tmpName));

    $lectures = array_slice($csvAsArray,7);

    foreach ($lectures as $value) {
      $error = $value[0];
      $utcoffset = $value[1];
      $localTimeStamp = $value[3];
      $aparentEnergy = $value[4];
      $realEnergy = $value[5];
      $reactiveEnergy = $value[6];

      $sql = "INSERT INTO lectures (error, utcoffset,lecturetimestamp,aparentenergy,realenergy,reactiveenergy)
      VALUES ($error, $utcoffset,$localTimeStamp,$aparentEnergy,$realEnergy,$reactiveEnergy)";

      if (mysqli_query($conn, $sql)) {
          echo "New record created successfully <br>";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }

?>
