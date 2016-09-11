<?php
ini_set('memory_limit','-1');
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
$server="localhost";
$username="hadjixen_openuse";
$password="123qweQWE";
$dbname="hadjixen_opendata";
// Try and connect to the database
$connection = new mysqli('localhost',$username,$password,$dbname);
$connection->set_charset("utf8");
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
header("content-type: text/html;charset=utf-8");

getCart($connection);
function getCart($connection) {
	//$result = $connection->query("SELECT name FROM $tableName");
	//$array = $result->fetch_assoc();
	$current_city = '3';//$_GET['city'];
	$current_user = '1';//$_GET['userid'];
	$result_cart = $connection->query("SELECT product FROM list_cart WHERE userid=$current_user");
	$resultArray = array();
	$storesArray = array();
	$productsArray = array();
	$counter = 1;
	while($row_product = $result_cart->fetch_assoc()) {
		$productsArray[] = $row_product['product'];
	}
	$counter = 1;
	$productsToString = implode(',', $productsArray);
	$result_stores = $connection->query("SELECT fk_store_id FROM products_stores WHERE fk_product_id IN ($productsToString) AND fk_city_name=$current_city LIMIT 4");
	while($row_stores = $result_stores->fetch_assoc()) {
		$storesArray[] = $row_stores;
	}
	//
	$visitedStores = array();
	$sumArray = array();
	$th = '';
	$td = '';
	$tr = '';
	$counter = 1;
	foreach($productsArray as $row_product) {//($row_product = $result_cart->fetch_assoc()) {
		$td = '';
		foreach($storesArray as $row_store) {//($row_store = $result_stores->fetch_assoc()) {
			$productid = $row_product;
			$store_id = $row_store['fk_store_id'];
			if(!array_key_exists($store_id, $sumArray)) {
				$sumArray[$store_id];
			}
			//get store name
			$store_name = $connection->query("SELECT name FROM stores WHERE id=$store_id");
			$store_name = $store_name->fetch_assoc();
			$store_name = $store_name['name'];
			if(!in_array($store_id, $visitedStores)) {
				$visitedStores[] = $store_id;
				$th .= "<th class='proth'>$store_name</th>";
			}
			$price_temp = $connection->query("SELECT fk_product_name, price FROM products_stores WHERE fk_product_id='$productid' AND fk_store_id='$store_id'");
			if($price = $price_temp->fetch_assoc()) {
				// $resultArray[$store_id][$counter]['storename'] = $row_store['names'];
				$product_name = $price['fk_product_name'];
				//$resultArray[$store_name][$product_name]['productname'] = $product_name;
				$aprice = $resultArray[$store_name][$product_name]['productprice'] = $price['price'];
				$td .= "<td>$aprice</td>";

				$toadd = $sumArray[$store_id];
				$sumArray[$store_id] = $toadd + $aprice;
				
			}
		}
		$tr .= "<tr class='prorow'><td class='pname' data-id='$productid'>$product_name</td>" . $td . "</tr>";
		$counter += 1;
	}
	foreach ($sumArray as $key => $value) {
		# code...
		$sumtd .= "<td>$value</td>";
	}
	$tr .= "<tr class='prorow'><td>ΣΥΝΟΛΟ: </td>" . $sumtd . "</tr>";
	if(1) {
		echo "<table id='carttable'>" . "<tr>" . "<th></th>" .$th . "</tr>" . $tr . "</table>";
		//echo $resultArray;
	} else {
		echo "<pre>";
		print_r($resultArray);echo "</pre>";
	}
}
?>