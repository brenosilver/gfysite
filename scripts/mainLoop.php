<?php

require_once('configDB.php');

class mainLoop{

	private
		$conn;

	public function __construct(){
		$this->conn = new configDB();
		$this->conn = $this->conn->connect();		

		$this->getPosts();
	}

	public function getPosts(){
		$stmnt = $this->conn->prepare("SELECT * FROM posts ORDER BY RAND() LIMIT 40");
		$stmnt-> execute();
		$result = $stmnt->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($result as $item){
			//echo "<div class='item' />";
			echo "<img class='gfyitem' data-controls='false' data-title='false' data-expand='false' data-autoplay='true' data-id='" . $item['link'] . "' />";
			//echo "</div>";
		}
		//alert($result.length());
		$this->disconnect();
	}

	public function disconnect(){
		if($this->conn != null)
			return $this->conn = null;
	}	
}

$loops = new mainLoop();
?>