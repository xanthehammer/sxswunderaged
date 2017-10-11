<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/showcase.php';

// instantiate database and showcase object
$database = new Database();
$db = $database->getConnection();

// initialize object
$showcase = new Showcase($db);

// query showcases
$stmt = $showcase->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // showcase array
    $showcaseArr = array();
    $showcaseArr["records"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $showcaseItem=array(
            "id" => $id,
            "name" => $name,
            "start_date" => $date_start,
            "end_date" => $date_end,
            "location" => $location,
            "all_ages" => $all_ages,
            "description" => $description,
            "url" => $url
        );

        array_push($showcaseArr["records"], $showcaseItem);
    }

    echo json_encode($showcaseArr);
}

else{
    echo json_encode(
        array("message" => "No showcases found.")
    );
}
?>