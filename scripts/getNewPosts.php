<?php
require_once('config.php');
require_once('functions.php');

class getNewPosts{
	
	private
		$conf,
		$conn,
		$results;
	
	public function __construct(){
		$this->conf = new config();
		$this->conn = $this->conf->connect();
			
		$this->getAPI();
		$this->insertPosts();
	}

	// Get the api containing the posts
	public function getAPI(){
		$request = "http://www.kimonolabs.com/api/8nn388dy?apikey=63e3cc2ad3f81b46982ce22cb887525a";
		$response = file_get_contents($request);
		return $this->results = json_decode($response, FALSE);
	}

	// Insert the posts in the DB
	// Only add if links are unique
	public function insertPosts(){
		if($this->getAPI() != null ){
			// prepare stm
			$stm = $this->conn->prepare("INSERT IGNORE INTO posts(title, link) VALUES(?, ?)");

			// execute stm
			foreach($this->results->{'results'} as $collection){
				foreach($collection as $item){
					
					// If image exists add it to the DB
					if(functions::img_exists($item->title->href)){
					
						$link = $this->gfyGif($item->title->href);
					
						$stm->bindParam(1, $item->title->text);
						$stm->bindParam(2, $link);
						$success = $stm-> execute();
						error_log("img added: " . $item->title->href . "\n", 3, "logs/imageAdded.log");
					}
					else
						error_log("img does not exist: " . $item->title->href . "\n", 3, "logs/imageAdded.log");
				}
			}
		}
		$this->disconnect();
	}
	
	// Request HTML5 Video of the given .gif from Gfycat.com
	public function gfyGif($url){
		$randKey = rand(10000, 9999999999);
		$parsedUrl = functions::parseUrl($url);
		$request = "http://upload.gfycat.com/transcode/$randKey?fetchUrl=$parsedUrl";
		
		$response = file_get_contents($request);
		$results = json_decode($response, FALSE);
		$gfyLink = $results->gfyname;
		
		return $gfyLink;
	}
		
	public function disconnect(){
		if($this->conn != null)
			return $this->conn = null;
	}
}

$newPosts = new getNewPosts();
?>