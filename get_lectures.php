<?php

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');

    require 'connection.php';

    $sql = "SELECT * FROM lectures";

    $result = mysqli_query($conn, $sql);

    $rows = mysqli_fetch_all($result);

    $filename = "lectures" . date('Y-m-d') . ".csv";
    $fp = fopen('php://memory', 'w');
    
    for ($i=0; $i < sizeof($rows) ; $i++) {
      $values = array_values($rows[$i]);
      fputcsv($fp, $values);
    }

    fseek($fp, 0);
    fpassthru($fp);

?>
