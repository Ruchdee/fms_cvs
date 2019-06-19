<?php 
class Settings {

    //database connection and table name
    private $conn;
    private $table_name = "settings";

    //table properties
    public $fac_name_th;
    public $fac_name_en;
    public $curr_semester;
    public $curr_ac_year;
    public $updated_by;
    public $updated_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read one record
    function readone() {
        $query = "SELECT * FROM " . $this->table_name;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //update record
    function update() {
        $query = "UPDATE " . $this->table_name . " SET fac_name_th = ?, fac_name_en = ?, curr_semester = ?, curr_ac_year = ?, updated_by = ?, updated_date = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssss', $this->fac_name_th, $this->fac_name_en, $this->curr_semester, $this->curr_ac_year, $this->updated_by, $this->updated_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }
}
?>