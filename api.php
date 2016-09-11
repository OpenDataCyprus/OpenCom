<?php


ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
$server = "localhost";
$username = "root";
$password = "";
$dbname = "datathon";
mb_internal_encoding('UTF-8');


$connection = new mysqli('127.0.0.1', $username, $password, $dbname);

$connection->set_charset("utf8");


header("content-type: text/html; charset=UTF-8");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$tableName = 'products';

//$result = $connection->query("SELECT name FROM $tableName");
//$array = $result->fetch_assoc();
$result = $connection->query("SELECT fk_product_name,(SELECT name from categories where id = fk_category_id) FROM products_stores");
$a = $result->fetch_all();

function christos($connection,$query) {


    $ar = array();
    //$result = $connection->query("SELECT name FROM $tableName");
    //$array = $result->fetch_assoc();
    $result = $connection->query($query);
    while($row = $result->fetch_assoc()) {
//        echo "<pre>";
//        print_r($row);
//        echo "</pre>";

        array_push($ar,$row);
    }


    return $ar;
}


$tempo = christos($connection,"SELECT fk_product_name,(SELECT name from categories where id = fk_category_id) FROM products_stores");

//print_r($tempo) ;

$result = array();

foreach ($tempo as $key => $value){
    //echo $value['fk_product_name'];
    //$bam = $value['(SELECT name from categories where id = fk_category_id)'] . ' ' . $value['fk_product_name'];
   // echo $bam;

    $raous = $value['(SELECT name from categories where id = fk_category_id)'] . ' | ' . $value["fk_product_name"];
    array_push($result,$raous);
}


//echo $result[100];

echo json_encode($result);

?>