<?php 
class Lecturer {

    //database connection and table name
    private $conn;
    private $table_name = "lecturers";

    public $lecturer_id;
    public $title_th;
    public $title_en;
    public $lecturer_name_th;
    public $lecturer_name_en;
    public $major_id;
    public $lecturer_status;
    public $created_by;
    public $created_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records 
    //$act = 1, show only active status, $act = 0, show all
    function readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE lecturer_status = 1 ORDER BY lecturer_id";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY lecturer_id";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE lecturer_id = '" . $this->lecturer_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (lecturer_id, title_th, title_en, lecturer_name_th, lecturer_name_en, major_id, lecturer_status, created_by, created_date) VALUES (?,?,?,?,?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssssss', $this->lecturer_id, $this->title_th, $this->title_en, $this->lecturer_name_th, $this->lecturer_name_en, $this->major_id, $this->lecturer_status, $this->created_by, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    




}
?>