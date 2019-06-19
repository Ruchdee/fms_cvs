<?php 
class Department {

    //database connection and table name
    private $conn;
    private $table_name = "departments";

    //table properties
    public $dept_id;
    public $dept_name_th;
    public $dept_name_en;
    public $dept_status;
    public $created_by;
    public $created_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records 
    //$act = 1, show only active status, $act = 0, show all
    public function readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE dept_status = 1 ORDER BY dept_id";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY dept_id";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE dept_id = '" . $this->dept_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (dept_id, dept_name_th, dept_name_en, dept_status, created_by, created_date) VALUES (?,?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssss', $this->dept_id, $this->dept_name_th, $this->dept_name_en, $this->dept_status, $this->created_by, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    //update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET dept_name_th = ?, dept_name_en = ?,  dept_status= ? WHERE dept_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ssss', $this->dept_name_th, $this->dept_name_en, $this->dept_status, $this->dept_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE dept_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->dept_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }
}
?>
