<?php 
function get_content($URL){
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $URL);
	  curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
      $data = curl_exec($ch);
      curl_close($ch);
      return $data;
}

if(!empty($_GET['id'])){
	$id= $_GET['id'];	
	$URL='http://pubapi.yp.com/search-api/search/devapi/listingmap?key=0z02n4301r&format=json&listingid='.urlencode($id);
	$JSON= get_content($URL);
	$array=json_decode($JSON,true);
	if(isset($array['map_url'])&&$array['map_url']!==''){
		$mapurl=$array['map_url'];
		echo "<a href='$mapurl'>Map</a>";
	}
	else{
		echo"No MAP!.";
	}
}
?>
<html>
<head>
<title> map </title>
</head>
</html>
