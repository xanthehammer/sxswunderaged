<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/showcase.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare showcase object
$showcase = new Showcase($db);

// set ID property of showcase
$showcase->id = ($_GET['id']);

// read the details of showcase
$showcase->readOne();

// create array
$showcase_arr = array(
    "id" =>  $showcase->id,
    "name" => $showcase->name,
    "start_date" => $showcase->date_start,
    "end_date" => $showcase->date_end,
    "location" => $showcase->location,
    "url" => $showcase->url,
    "all_ages" => $showcase->all_ages,
    "description" => $showcase->description
);

// make it json format
print_r(json_encode($showcase_arr));
?>