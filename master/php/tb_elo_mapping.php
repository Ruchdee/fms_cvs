<?php 
class Elo_mapping {
    
    //database connection and table name
    private $conn;
    private $table_name = "elos_mapping";
    //private $table_name_1 = "courses";

    //table properties
    public $course_id;
    public $elo_id;
    public $is_verified;
    public $created_by;
    public $created_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records 
    //$act = 1, show only active status, $act = 0, show all
    /* function readall($act) {
        if ($act) {
            $query = "SELECT " . $this->table_name . ".*, " . $this->table_name_1 . ".course_code, " . $this->table_name_1 . ".course_name_th, " . $this->table_name_1 . ".major_id FROM " . $this->table_name . " INNER JOIN " . $this->table_name_1 . " ON " . $this->table_name . ".course_id = " . $this->table_name_1 . ".course_id WHERE " . $this->table_name_1 . ".course_status = 1 ORDER BY " . $this->table_name . ".course_id";
            //echo "<script>console.log(" . $query .")</script>";
        } else {
            $query = "SELECT " . $this->table_name . ".*, " . $this->table_name_1 . ".course_code, " . $this->table_name_1 . ".course_name_th, " . $this->table_name_1 . ".major_id FROM " . $this->table_name . " INNER JOIN " . $this->table_name_1 . " ON " . $this->table_name . ".course_id = " . $this->table_name_1 . ".course_id ORDER BY " . $this->table_name . ".course_id";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    } */

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE course_id = '" . $this->course_id . "' AND elo_id = '" . $this->elo_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readonecourse(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE course_id = '" . $this->course_id . "' ORDER BY elo_id";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (course_id, elo_id, is_verified, created_by, created_date) VALUES (?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'sssss', $this->course_id, $this->elo_id, $this->is_verified, $this->created_by, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    // update record
    function update() {
        $query = "UPDATE " . $this->table_name . " SET is_verified = ? WHERE course_id = ? AND elo_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sss', $this->is_verified, $this->course_id, $this->elo_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE course_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->course_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

}

?>