<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
$server = "localhost";
$username = "root";
$password = "";
$dbname = "datathon";
// Try and connect to the database
$connection = new mysqli('127.0.0.1', $username, $password, $dbname);
$connection->set_charset("utf8");
/* check connection */


if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


header("content-type: text/html;charset=utf-8");
require_once "PHPExcel/Classes/PHPExcel.php";
echo "<br>Hello Open Data Comp! <br>";



//1 is mikron 2 is megalon 3 is online
$storeType = "2";//set store type before
//readXMLFile("amochostos_paratiritirio_megalon_peragoron_01-12-2015.xls"); //test 1 file
$megalonFiles = array('amochostos_paratiritirio_megalon_peragoron_01-12-2015.xls',
    'amochostos_paratiritirio_megalon_peragoron_02-03-2016.xls',
    'amochostos_paratiritirio_megalon_peragoron_25-07-2016.xls',
    'amochostos_paratiritirio_megalon_peragoron_25-08-2015.xls',
    'larnaka_paratiritirio_megalon_peragoron_01-12-2015.xls',
    'larnaka_paratiritirio_megalon_peragoron_02-03-2016.xls',
    'larnaka_paratiritirio_megalon_peragoron_25-07-2016.xls',
    'larnaka_paratiritirio_megalon_peragoron_25-08-2015.xls',
    'lefkosia_paratiritirio_megalon_iperagoron_24-08-2015.xls',
    'lefkosia_paratiritirio_megalon_peragoron_01-12-2015.xls',
    'lefkosia_paratiritirio_megalon_peragoron_02-03-2016.xls',
    'lefkosia_paratiritirio_megalon_peragoron_25-07-2016.xls',
    'lemesos_paratiritirio_megalon_peragoron_01-12-2015.xls',
    'lemesos_paratiritirio_megalon_peragoron_02-03-2016.xls',
    'lemesos_paratiritirio_megalon_peragoron_25-07-2016.xls',
    'lemesos_paratiritirio_megalon_peragoron_25-08-2015.xls',
    'pafos_paratiritirio_megalon_peragoron_01-12-2015.xls',
    'pafos_paratiritirio_megalon_peragoron_02-03-2016.xlsx',
    'pafos_paratiritirio_megalon_peragoron_25-07-2016.xls',
    'pafos_paratiritirio_megalon_peragoron_25-08-2015.xlsx');



foreach ($megalonFiles as $key => $value) {
    readXMLFile($value, $storeType, $connection);
}



function checkExists($connection, $name, $tableName, $secPar = '')
{
    //remember stores also have their city => check a and b
    $result = 0;
    $extraClause = '';
    if ($secPar != '') {
        $extraClause = " AND city=$secPar";
    }
    $query = "SELECT id from $tableName WHERE name='$name'" . $extraClause;
    $run_query = $connection->query($query);
    if ($row = $run_query->fetch_assoc()) {
        $result = $row['id'];
    }
    return $result;
}
function insertMergedTable($connection, $fk_product_id, $fk_store_id, $fk_product_name, $fk_city_name, $fk_category_id, $price, $on_offer, $date)
{
    echo "inserting the big data..<br>";
    $query = "INSERT INTO products_stores (id, fk_product_id,fk_store_id,fk_product_name,fk_city_name,fk_category_id,price,on_offer,entry_date) 
									VALUES (DEFAULT, '$fk_product_id','$fk_store_id', '$fk_product_name', '$fk_city_name', '$fk_category_id', '$price', '$on_offer', '$date');";
    $connection->query($query);
}


//insert category if does not exist
function insertRow($connection, $name, $tableName, $secPar = '')
{
    echo "insert $name in $tableName #$secPar#<br>";
    $extraClause = '';
    //check if entry exists
    $row_id = $exsists = checkExists($connection, $name, $tableName, $secPar);
    //if it does not exist insert, otherwise do nothing!!!
    if (!$exsists) {
        if ($secPar != '') {
            $extraClause = ",'$secPar'";
        }
        //does not exist, insert row!
        $query = "INSERT INTO $tableName VALUES (DEFAULT,'$name'$extraClause);";
        $connection->query($query);
        $row_id = $connection->insert_id;
    }
    return $row_id;
}  //calls checkExist


function readXMLFile($tempFileName, $storeType, $connection)
{
    $cities_array = array("ΛΕΥΚΩΣΙΑΣ", "ΛΕΜΕΣΟΥ", "ΛΑΡΝΑΚΑΣ", "ΑΜΜΟΧΩΣΤΟΥ", "ΠΑΦΟΥ");
    $tmpfname = "govdata/" . $tempFileName;
    $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
    $excelObj = $excelReader->load($tmpfname);
    $data_date = '';
    #$workSheet = $excelObj->getActiveSheet();
    foreach ($excelObj->getWorksheetIterator() as $workSheet) {
        $lastRow = $workSheet->getHighestDataRow();
        $lastColumn = $workSheet->getHighestDataColumn();

        //city
        $data_city_string = $workSheet->getCell("A3");
        foreach ($cities_array as $key => $value) {
            if (strpos($data_city_string, $value) !== false) {
                $data_city = $value;
            }
        }

        //date
        $date_formula = $workSheet->getCell("A4"); //some sheets use formula and get the date from the first spreadsheet
        $date_formula .= "";
        if ($date_formula[0] != "=") {
            $data_date = explode(" ", $date_formula);
            $data_date = str_replace("/", "-", $data_date[1]);
        }
        ///////////////// start /////////////////
        $dataArray = array();
        $storesArray = array();
        // stores go from B7 and go up to N7
        $storesColumn = "B";
        $storesLastColumn = "N";
        foreach (range($storesColumn, $storesLastColumn) as $key => $value) {
            $lookingAt = $workSheet->getCell($value . "7")->getValue();
            if ($lookingAt != '') {
                $storesArray[$value . "7"]['storeName_7'] = $lookingAt;
            }
        }
        // echo "<pre>";
        // print_r($storesArray);
        // echo "</pre>";
        // die;

        // products table row starts at B11
        $productsColumn = "C";
        $productsLastColumn = "N";
        $category = '';
        for ($row = 11; $row <= $lastRow; $row++) {
            $storeBeingProcessed = 0;
            foreach (range($storesColumn, $storesLastColumn) as $key => $value) {
                $lookingAt = $workSheet->getCell($value . $row)->getValue();

                if (array_key_exists($value . "7", $storesArray)) {
                    $storeBeingProcessed = $storesArray[$value . "7"]['storeName_7'];
                }
                $checkCategoryIndex = $workSheet->getCell('A' . $row)->getValue();
                if ($checkCategoryIndex == '') {
                    //continue if category line
                    $category = $lookingAt;
                    break;
                }
                //B is product name, after is price in each store
                $checkProductNameIndex = $workSheet->getCell('B' . $row)->getValue();
                if ($checkProductNameIndex == "ΟΝΟΜΑΣΙΑ ΚΑΙ ΕΙΔΟΣ ΠΡΟΙΟΝΤΟΣ") {
                    break;
                }
                if ($lookingAt != '') {
                    #$dataArray[$row][$data_being_stored] = $lookingAt;
                    if ($storeBeingProcessed) {
                        $dataArray[$row][$storeBeingProcessed]['City'] = $data_city;
                        $dataArray[$row][$storeBeingProcessed]['Date'] = $data_date;
                        $dataArray[$row][$storeBeingProcessed]['Store'] = $storeBeingProcessed;
                        $dataArray[$row][$storeBeingProcessed]['ProductName'] = $checkProductNameIndex;
                        if ($lookingAt == '*') {
                            //get next colummn to check if offer
                            $dataArray[$row][$storeBeingProcessed]['offer'] = 1;
                        } else {
                            $dataArray[$row][$storeBeingProcessed]['price'] = $lookingAt;
                            $dataArray[$row][$storeBeingProcessed]['offer'] = 0;
                        }
                        if ($category == '') {
                            //if category is empty, the spreadsheet MIGHT not have a category placed..
                            //$category = 'General';
                            $category = $workSheet->getTitle();
                        }
                        $dataArray[$row][$storeBeingProcessed]["category"] = $category;
                        #$dataArray[$row]["store"] = $storeBeingProcessed;
                    }
                }
            }
        }
        insertWorkSheetToDatabase($dataArray, $connection);
    }
}

//echo checkExists($connection,'Megalon','store_types'); //seems to work
//echo insertRow($connection,'testtest','store_types'); //seems to work, returns insered data row
//function insertMergedTable($connection, $fk_product_id,$fk_store_id, $fk_product_name, $fk_city_name, $fk_category_id, $price,on_offer, $date) // not tested!!!

function insertWorkSheetToDatabase($dataArray, $connection)
{
    // echo "<pre>";
    // print_r($dataArray); //array is carried over;
    // echo "</pre>";
    echo "inserting rows... <br>";
    foreach ($dataArray as $key => $stores) {
        foreach ($stores as $key => $actualValues) {
            //must be first
            //category
            $category = addslashes($actualValues['category']);
            $catId = addslashes(insertRow($connection, $category, 'categories'));
            //city
            $city = addslashes($actualValues['City']);
            $cityId = addslashes(insertRow($connection, $city, 'cities'));
            //product
            $productName = addslashes($actualValues['ProductName']);
            $productNameId = addslashes(insertRow($connection, $productName, 'products'));
            //store
            $store = addslashes($actualValues['Store']);
            $storeId = addslashes(insertRow($connection, $store, 'stores', $cityId));

            //insert after -- data for joined table
            $date = addslashes($actualValues['Date']);
            $price = addslashes($actualValues['price']);
            $isOffer = addslashes($actualValues['offer']);

            //insertMergedTable($connection, $fk_product_id,$fk_store_id, $fk_product_name, $fk_city_name, $fk_category_id, $price, $on_offer, $date);
            insertMergedTable($connection, $productNameId, $storeId, $productName, $city, $catId, $price, $isOffer, $date);
        }
    }
}





?>