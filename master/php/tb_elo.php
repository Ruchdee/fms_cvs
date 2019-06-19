<?php 
class Elo {

    //database connection and table name
    private $conn;
    private $table_name = "elos";

    //table properties
    public $elo_id;
    public $elo_desc;
    public $elo_type;
    public $major_id;
    public $elo_status;
    public $created_by;
    public $created_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records 
    //$act = 1, show only active status, $act = 0, show all
    public function readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE elo_status = 1 ORDER BY elo_id";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY elo_id";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE elo_id = '" . $this->elo_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read by major id
    function readbymajor_id(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE major_id = '" . $this->major_id . "' ORDER BY elo_type, elo_id";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (elo_id, elo_desc, elo_type, major_id, elo_status, created_by, created_date) VALUES (?,?,?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssss', $this->elo_id, $this->elo_desc, $this->elo_type, $this->major_id, $this->elo_status, $this->created_by, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    //update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET elo_desc = ?, elo_type = ?, major_id = ?, elo_status = ? WHERE elo_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sssss', $this->elo_desc, $this->elo_type, $this->major_id, $this->elo_status, $this->elo_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE elo_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->elo_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    function getnew_id() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE elo_id LIKE '%" . $this->major_id . "%'";
        $result = mysqli_query($this->conn, $query);
        $elo_no = mysqli_num_rows($result);
        return $this->major_id . "-" . str_pad($elo_no+1, 2, '0', STR_PAD_LEFT);
    }

}

?>