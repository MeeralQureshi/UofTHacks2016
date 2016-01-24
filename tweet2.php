<?php
require_once 'lib/twitteroauth.php';
 
define('CONSUMER_KEY', 'XgA2skxeI3KqNkZAKvwIsM6k6');
define('CONSUMER_SECRET', 'N3g1GntYFpvrX2g3pZQPMeH74gL4DZgfVMe3a6QYPzx34ul0Zv');
define('ACCESS_TOKEN', '4837643469-0l7fqURQzp9QBH01qcXJk6WOWHNYacV4I5j4uCH');
define('ACCESS_TOKEN_SECRET', '6WJxt4Yn7UmLjigfYazoiJLbXHcsFNfaOwvYJ7QCQrD3u');
 
$toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
 
$query = array(
    "q" => "#SpotMissing",
    "result_type" => "recent"
);
 
$results = $toa->get('search/tweets', $query);
 
foreach ($results->statuses as $result) {
  echo $result->user->screen_name . ": " . $result->text . "\n";
}