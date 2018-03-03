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
	$URL='http://pubapi.yp.com/search-api/search/devapi/coupons?format=json&key=0z02n4301r&searchloc=91203';
	$JSON= get_content($URL);
	$array=json_decode($JSON,true);
	$searchlisting= $array["searchResult"]["searchListings"]["searchListing"];
	foreach($searchlisting as $i){
		if(isset($i['businessName'])&&$i['businessName']!==''&&isset($i['websiteURL'])&&$i['websiteURL']!==''){
			$name= $i["businessName"];
			$url= $i["websiteURL"];
			echo"&nbsp &nbsp<a href='$url'>$name </a><br>";
		}
		elseif(isset($i['businessName'])&&$i['businessName']!==''){
			$name= $i["businessName"];
			echo"&nbsp &nbsp $name<br>";
		}
		if(isset($i['city'])&&$i['city']!==''){
			$city= $i["city"];
			echo"City: $city <br>";
		}
		if(isset($i['couponCount'])&&$i['couponCount']!==''){
			$count=$i["couponCount"];
			echo"Count: $count <br>";
		}
		if(isset($i['phone'])&&$i['phone']!==''){
			$phone=$i["phone"];
			echo"Phone: $phone<br>";
		}
		if(isset($i['state'])&&$i['state']!==''){
			$state=$i["state"];
			echo"State: $state<br>";
		}
		if(isset($i['street'])&&$i['street']!==''){
			$street=$i["street"];
			echo"Street: $street<br><br><br>";
		}
	}
?>
<html>
<head>
<title> coupons </title>
</head>
</html>