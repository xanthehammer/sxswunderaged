<?php
class Artist{

    // database connection and table name
    private $conn;
    private $table_name = "ARTIST";

    // object properties
    public $id;
    public $name;
    public $origin;
    public $website;
    public $info;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Used for Artist Info Page
    function readOne(){

        $query = "SELECT
                id, name, website, info, origin
                FROM " . $this->table_name . "
                WHERE id = ?";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->name = $row['name'];
        $this->origin = $row['origin'];
        $this->website = $row['website'];
        $this->info = $row['info'];

    }

}