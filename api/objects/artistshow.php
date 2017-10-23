<?php
class ArtistShow{

    // database connection and table name
    private $conn;
    private $table_name = "ARTIST_SHOW";

    // object properties
    public $id;
    public $showcasedate;
    public $showcaseid;
    public $artistid;
    public $artistname;
    public $starttime;
    public $notes;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read showcases instances
    function read(){

        // select all query
        $query = "SELECT ashow.id, sd.showcase_id as showcaseid, sd.showcase_date as showcasedate, ashow.artist_id as artistid, a.name as artistname, ashow.start_time as starttime, ashow.notes
                FROM " . $this->table_name . " ashow, ARTIST a, SHOWCASE_DAY sd
                WHERE ashow.artist_id = a.id
                AND ashow.showcase_day_id = sd.id
                AND sd.showcase_id = ?  
                ORDER BY sd.showcase_date, ashow.start_time";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->showcaseid);

        // execute query
        $stmt->execute();

        return $stmt;
    }


}