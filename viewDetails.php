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
	$URL='http://pubapi.yp.com/search-api/search/devapi/details?listingid='.urlencode($id).'&key=0z02n4301r&format=json';
	$JSON= get_content($URL);
	$array=json_decode($JSON,true);
}
?>
<html>
<head>
<title> view details </title>
</head>
<body>
<?php
		echo '<form action="viewReviews.php">';
		
		$details=$array['listingsDetailsResult']['listingsDetails']['listingDetail'][0];
		if(isset($details['businessName'])&&$details['businessName']!==''){
			$bName=$details['businessName'];
			echo"Bussiness Name: $bName<br>";
		}
		if(isset($details['adImage'])&&isset($details['adImageClick'])&&$details['adImage']!==''&&$details['adImageClick']!==''){
			$clicked=$details['adImageClick'];
			$image=$details['adImage'];
			echo"<a href='$clicked'><img src='$image'></a><br>";
		}
		if(isset($details['averageRating'])&&$details['averageRating']!==''){
			$avg= $details['averageRating'];
			echo"average rating: $avg<br>";
		}
		echo" Categories: <br>";
		foreach($details['categories']['category'] as $category){
			echo "&nbsp &nbsp &nbsp $category <br>";
		}
		if(isset($details['city'])&&$details['city']!==''){
			$city=$details['city'];
			echo" City:  $city <br>";
		}
		if(isset($details['generalInfo'])&&$details['generalInfo']!==''){
			$generalinfo=$details['generalInfo'];
			echo" General Info: $generalinfo <br>";
		}
		if(isset($details['openHours'])&&$details['openHours']!==''){
			$hours=$details['openHours'];
			echo" Open hours: $hours <br>";
		}
		if(isset($details['paymentMethods'])&&$details['paymentMethods']!==''){
			$payment=$details['paymentMethods'];
			echo"Payment method: $payment<br>";
		}
		if(isset($details['phone'])&&$details['phone']!==''){
			$phone=$details['phone'];
			echo"Phone: $phone<br>";
		}
		if(isset($details['services'])&&$details['services']!==''){
			$service=$details['services'];
			echo"Services: $service<br>";
		}
		if(isset($details['street'])&&$details['street']!==''){
			$street=$details['street'];
			echo"Street: $street<br>";
		}
	echo '<input type="hidden" name="id" value="'.$id.'">';
	?>
	
	<br>
	<button type="submit"> Review</button>
	<?php
		
	?>
</form>
<form action="map.php">
	<?php
		echo '<input type="hidden" name="id" value="'.$id.'">';
	?>
	<button type="submit"> Map </button>
</form>
</body>
</html>
