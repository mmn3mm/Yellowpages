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


?>
<html>
<head>
<title> search </title>
</head>
<body>
<form action=""  >
	<input type="text" name="search"/>
	<button type="submit"> search</button>
	<br>
	<?php 
	if(!empty($_GET['search'])){
	$URL='http://pubapi.yp.com/search-api/search/devapi/search?searchloc=91203&term='.urlencode($_GET['search']).'&format=json&key=0z02n4301r';
	$JSON= get_content($URL);
	$array=json_decode($JSON,true);
	foreach($array['searchResult']['searchListings']['searchListing'] as $i)
	{
		$id=$i['listingId'];
		$name=$i['businessName'];
	    echo "<a href='viewDetails.php?id=$id'>$name</a>";
		echo "<br><br>";
	}
}
		?>
</form>
<form action="Coupons.php">

	<button type="submit"> Copoun </button>
</form>
</body>
</html>
