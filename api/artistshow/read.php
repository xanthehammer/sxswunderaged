<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/artistshow.php';

// instantiate database and showcase object
$database = new Database();
$db = $database->getConnection();

// initialize object
$artistshow = new ArtistShow($db);

// set ID property of showcase
$artistshow->showcaseid = ($_GET['id']);

// query showcases
$stmt = $artistshow->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // showcase array
    $artistShowArr = array();
    $artistShowArr["records"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $artistShowItem=array(
            "id" => $id,
            "showcasedate" => $showcasedate,
            "showcaseid" => $showcaseid,
            "artistid" => $artistid,
            "artistname" => $artistname,
            "starttime" => $starttime,
            "notes" => $notes
        );

        array_push($artistShowArr["records"], $artistShowItem);
    }

    echo json_encode($artistShowArr);
}

else{
    echo json_encode(
        array("message" => "No showcases found.")
    );
}
?>