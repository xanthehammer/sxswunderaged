<?php
class ShowcaseDay{

    // database connection and table name
    private $conn;
    private $table_name = "SHOWCASE_DAY";

    // object properties
    public $id;
    public $showcaseid;
    public $day_id;
    public $name;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read showcases instances
    function read(){

        // select all query
        $query = "SELECT scd.id as id, sc.id as showcaseid, sc.name, scd.day_id
                FROM " . $this->table_name . " scd, SHOWCASE sc
                WHERE sc.id = scd.showcase_id
                ORDER BY day_id, sc.name";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }


}