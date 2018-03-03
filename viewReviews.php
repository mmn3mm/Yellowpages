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
	$URL='http://pubapi.yp.com/search-api/search/devapi/reviews?listingid='.urlencode($id).'&key=0z02n4301r&format=json';
	$JSON= get_content($URL);
	$array=json_decode($JSON,true);
}
?>
<html>
<head>
<title> reviews </title>
</head>
<body>
<form action=""  >
	<?php
		$reviews=$array['ratingsAndReviewsResult']['reviews'];
		if(!isset($reviews['review'])){
				echo "No reviews exist";
		}else
		{
			$reviews=$reviews['review'];
			foreach($reviews as $i){
				$rating=$i['rating'];
				echo "Rate: $rating<br>";
				$body=$i["reviewBody"];
				echo"Review: $body<br>";
				$reviewer=$i["reviewer"];
				echo "Reviewer : $reviewer<br>";
			}
		}
	?>

</form>
</body>
</html>
