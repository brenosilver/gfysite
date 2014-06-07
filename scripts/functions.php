<?php
class functions{
	
	// Function to check if the url points to an image.
	public static function img_exists($url){
		list($width, $height, $type, $attr) = @getimagesize($url);

		if($width == null) 		return false;
		elseif($height == null) return false;
		elseif($type == null) 	return false;
		elseif($attr == null) 	return false;
		
		return true;
	}
	
	// Parse the given url and return the domain + path
	public static function parseUrl($uri){
		$parsedURI = parse_url($uri);
		return $parsedURI['host'] . $parsedURI['path'];
	}
	
}
?>