<html>
    <body>
<?php
    echo "TESTES";
    echo $_GET["name"];
    echo $_GET["phone"];
    echo $_GET["address"];
    echo $_GET["city"];
    echo $_GET["state"];
        
    function convAddr($addr) {
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/json?address='+ $addr+'&region=ca&key=AIzaSyDsCm6RND11bnOXGGQn1rGv-yg4U2snilc',
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        $obj = json_decode($resp);
        
        // https://developers.google.com/maps/documentation/geocoding/intro
        // Region Basing section
        $long = $obj['results']['location']['lng'];
        $lat = $obj['results']['location']['lat'];
        
        return [$long, $lat];
    }
?>
    </body>
    
</html>