<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/showcaseday.php';

// instantiate database and showcase object
$database = new Database();
$db = $database->getConnection();

// initialize object
$showcaseday = new ShowcaseDay($db);

// query showcases
$stmt = $showcaseday->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // showcase array
    $showcasedayArr = array();
    $showcasedayArr["records"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $showcasedayItem=array(
            "id" => $id,
            "showcaseid" => $showcaseid,
            "day_id" => $day_id,
            "name" => $name
        );

        array_push($showcasedayArr["records"], $showcasedayItem);
    }

    echo json_encode($showcasedayArr);
}

else{
    echo json_encode(
        array("message" => "No showcases found.")
    );
}
?>