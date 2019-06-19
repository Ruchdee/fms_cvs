<?php 
class Major {

    //database connection and table name
    private $conn;
    private $table_name = "majors";

    //table properties
    public $major_id;
    public $major_name_th;
    public $major_name_en;
    public $dept_id;
    public $major_status;
    public $created_by;
    public $created_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records 
    //$act = 1, show only active status, $act = 0, show all
    function readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE major_status = 1 ORDER BY major_id";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY major_id";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read major data by department id
    function readbydept_id() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE dept_id = '" . $this->dept_id . "' AND major_status = 1 ORDER BY major_id";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE major_id = '" . $this->major_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (major_id, major_name_th, major_name_en, dept_id, major_status, created_by, created_date) VALUES (?,?,?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssss', $this->major_id, $this->major_name_th, $this->major_name_en, $this->dept_id, $this->major_status, $this->created_by, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    //update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET major_name_th = ?, major_name_en = ?, dept_id = ?, major_status = ? WHERE major_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sssss', $this->major_name_th, $this->major_name_en, $this->dept_id, $this->major_status, $this->major_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE major_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->major_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

}
?>