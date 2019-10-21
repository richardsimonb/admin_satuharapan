<?php

// koneksi ke mysql
mysql_connect("localhost","satuhara_usernya","123qwe");
mysql_select_db("satuhara_14feb2");

$query = "SELECT Distinct tt_news.title, tt_news.uid, bitly.bitly
		 FROM tt_news,bitly
		  WHERE tt_news.uid = bitly.uid 
		  AND hidden = 0
		  ORDER BY uid DESC LIMIT 0,1";
		  
$hasil = mysql_query($query);
 
// mencetak blok item dalam RSS untuk 3 artikel terbaru
while ($data = mysql_fetch_array($hasil))

$status1hope = $data['title'].". ".$data['bitly'];


// Load the app's OAuth tokens into memory
require 'app_tokens.php';

// Load the tmhOAuth library
require 'tmhOAuth.php';

// Create an OAuth connection to the Twitter API
$connection = new tmhOAuth(array(
  'consumer_key'    => $consumer_key,
  'consumer_secret' => $consumer_secret,
  'user_token'      => $user_token,
  'user_secret'     => $user_secret
));

// Send a tweet
$code = $connection->request('POST', 
	$connection->url('1.1/statuses/update'), 
	array('status' => $status1hope));

// A response code of 200 is a success
/*if ($code == 200) {
  print "Tweet sent";
} else {
  print "Error: $code";
}*/

?>
                            
                            
                            
                            