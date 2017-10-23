<?php
class ShowcaseDay{

    // database connection and table name
    private $conn;
    private $table_name = "SHOWCASE_DAY";

    // object properties
    public $id;
    public $showcaseid;
    public $showcasedate;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read showcases instances
    function read(){

        // select all query
        $query = "SELECT id, showcase_id as showcaseid, showcasedate
                FROM " . $this->table_name;

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }


}