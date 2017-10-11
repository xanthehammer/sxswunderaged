<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/artist.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare artist object
$artist = new Artist($db);

// set ID property of artist
$artist->id = ($_GET['id']);

// read the details of artist
$artist->readOne();

// create array
$artist_arr = array(
    "id" =>  $artist->id,
    "name" => $artist->name,
    "origin" => $artist->origin,
    "website" => $artist->website,
    "info" => $artist->info,
);

// make it json format
print_r(json_encode($artist_arr));
?>