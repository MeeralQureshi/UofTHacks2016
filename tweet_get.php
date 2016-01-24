<?php

require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "4837643469-0l7fqURQzp9QBH01qcXJk6WOWHNYacV4I5j4uCH",
    'oauth_access_token_secret' => "6WJxt4Yn7UmLjigfYazoiJLbXHcsFNfaOwvYJ7QCQrD3u",
    'consumer_key' => "XgA2skxeI3KqNkZAKvwIsM6k6",
    'consumer_secret' => "N3g1GntYFpvrX2g3pZQPMeH74gL4DZgfVMe3a6QYPzx34ul0Zv"
);

$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=#SpotMissing';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings, CURLOPT_SSL_VERIFYPEER);
echo $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();  


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
    <title>Hi</title>
</head>

<body>
</body>
</html>
