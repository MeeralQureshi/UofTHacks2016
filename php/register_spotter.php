<html>
    <body>
<?php
        
    $servername = "server36.000webhost.com";
    $username = "a2117997_FF";
    $password = "codepanda18";
    $dbname = "a2117997_SDB";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
        
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
        
    $sql = "INSERT INTO Spotter (SID, Longitude, Latitude)
    VALUES ($_GET["phone"], $long, $lat)";
        
    if ($conn->query($sql) === TRUE) {
        echo "Spotter added successfully!";
    } else {
        echo "Error adding apotter: " . $conn->error;
    }
    
?>
    </body>
    
</html>