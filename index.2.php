<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
$server = "localhost";
$username = "root";
$password = "";
$dbname = "datathon";
// Try and connect to the database
$connection = new mysqli('localhost', $username, $password, $dbname);
$connection->set_charset("utf8");
/* check connection */


if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

header("content-type: text/html;charset=utf-8");
require_once "PHPExcel/Classes/PHPExcel.php";



$tmpfname = "govdata/amochostos_paratiritirio_megalon_peragoron_01-12-2015.xls";

$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
$excelObj = $excelReader->load($tmpfname);

foreach ($excelObj->getWorksheetIterator() as $workSheet) {
    $lastRow = $workSheet->getHighestDataRow();
    $e = $workSheet->getHighestRow("D");
    echo "$workSheet";
}

























?>