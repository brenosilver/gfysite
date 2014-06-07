<?php

require_once('config.php');

class api{
	
	private
		$conn;
		
	public function __construct(){
		$this->conn = new config();
		$this->conn = $this->conn->connect();
		
		$this->getPosts();
	}
	
	public function getPosts(){
		$stmnt = $this->conn->prepare("SELECT * FROM posts ORDER BY RAND() LIMIT 40");
		$stmnt-> execute();
		$result = $stmnt->fetchAll(PDO::FETCH_ASSOC);
		
		echo json_encode($result);
		
		$this->disconnect();
	}
	
	private function disconnect(){
		if($this->conn != null)
			return $this->conn = null;
	}
}

$postsApi = new api();
?>