<?php 
class Course {

    //database connection and table name
    private $conn;
    private $table_name = "courses";

    //table properties
    public $course_id;
    public $course_code;
    public $course_name_th;
    public $course_name_en;
    public $major_id;
    public $course_credit;
    public $is_mapped;
    public $course_status;
    public $created_by;
    public $created_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records 
    //$act = 1, show only active status, $act = 0, show all
    function readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE course_status = 1 ORDER BY course_id";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY course_id";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read all courses which already are mapped with expected learning outcomes
    function readallmapping($is_mapped) {
        if ($is_mapped) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE is_mapped = 1 AND course_status = 1 ORDER BY course_id";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " WHERE is_mapped = 0 AND course_status = 1 ORDER BY course_id";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE course_id = '" . $this->course_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (course_code, course_name_th, course_name_en, major_id, course_credit, is_mapped, course_status, created_by, created_date) VALUES (?,?,?,?,?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssssss', $this->course_code, $this->course_name_th, $this->course_name_en, $this->major_id, $this->course_credit, $this->is_mapped, $this->course_status, $this->created_by, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    //update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET course_code = ?, course_name_th = ?, course_name_en = ?, major_id = ?, course_credit = ?, course_status = ? WHERE course_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssss', $this->course_code, $this->course_name_th, $this->course_name_en, $this->major_id, $this->course_credit, $this->course_status, $this->course_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //update is_mapped
    function update_is_mapped() {
        $query = "UPDATE " . $this->table_name . " SET is_mapped = ? WHERE course_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ss', $this->is_mapped, $this->course_id);

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