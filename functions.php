<?php
// Call Config
require "mdl-config.php";

// Class Database Connected
class DBGlobal {
	public function __construct(){
		$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		if($conn->connect_error){
			die ("<h1>Database Connection Failed</h1>");
		}
		//echo "Database Connected Successfully";
        return $this->conn = $conn;
	}
}

?>