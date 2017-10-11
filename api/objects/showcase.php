<?php
class Showcase{

    // database connection and table name
    private $conn;
    private $table_name = "SHOWCASE";

    // object properties
    public $id;
    public $name;
    public $date_start;
    public $date_end;
    public $location;
    public $url;
    public $all_ages;
    public $description;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read showcases
    function read(){

        // select all query
        $query = "SELECT
                sc.id, sc.name, sc.date_start, sc.date_end, l.name as location, sc.url, sc.all_ages, sc.description
                FROM " . $this->table_name . " sc, LOCATION l
                WHERE sc.location = l.id
                ORDER BY sc.name";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // Used for Showcase Info Page
    function readOne(){

        $query = "SELECT
                sc.id, sc.name, sc.date_start, sc.date_end, l.name as location, sc.url, sc.all_ages, sc.description
                FROM " . $this->table_name . " sc, LOCATION l
                WHERE sc.location = l.id
                AND sc.id = ?";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->name = $row['name'];
        $this->date_start = $row['date_start'];
        $this->date_end = $row['date_end'];
        $this->location = $row['location'];
        $this->url = $row['url'];
        $this->all_ages = $row['all_ages'];
        $this->description = $row['description'];
    }
}