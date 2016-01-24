<?php
    
    require "twilio-php-master/Services/Twilio.php";
        
    // ----------------------TWILIO------------------------------------
    
 
    // Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
    $AccountSid = "ACdadfc90dba80efa5925569edcc7bb13b";
    $AuthToken = "2f622c44c25755edc76f6da736feba45";
 
    // Step 3: instantiate a new Twilio Rest Client
    $client = new Services_Twilio($AccountSid, $AuthToken);



    if(empty($_POST['name'])  || 
       empty($_POST['phone']))
    {
        $errors .= "\n Error: all fields are required";
    }

    $name = $_POST['name']; 
    $phone = $_POST['phone']; 
 
    // Step 4: make an array of people we know, to send them a message. 
    // Feel free to change/add your own phone number and name here.
    $people = array(
        $phone => $name,
    );
 
    // Step 5: Loop over all our friends. $number is a phone number above, and 
    // $name is the name next to it
    foreach ($people as $number => $name) {
 
        $sms = $client->account->messages->sendMessage(
 
        // Step 6: Change the 'From' number below to be a valid Twilio number 
        // that you've purchased, or the (deprecated) Sandbox number
            "289-796-0748", 
 
            // the number we are sending to - Any phone number
            $number,
 
            // the sms body
            "Hey $name, Welcome to Spotter."
        );
        // Display a confirmation message on the screen
        $link_address = "index.html"
        echo "Testing. Sent message to $name";
        echo "<a href='".$link_address."'>Back to Spotter</a>";
    }
        
        
    // ----------------------DATABASE------------------------------------
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
    
    //=============Create Relations====================
    

    // Relation 'Missing': Missing Persons

    $sql = "CREATE TABLE IF NOT EXISTS Missing (
        MID int NOT NULL AUTO_INCREMENT,
        TweetURL varchar(255) NOT NULL,
        Longitude float NOT NULL,
        Latitude float NOT NULL,
        TimeCreated int,
        PRIMARY KEY (MID)
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table Missing created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // Relation 'Spotter': People looking out for missing persons
    // Note: SID is phone number of the spotter

    $sql = "CREATE TABLE IF NOT EXISTS Spotter (
        SID int NOT NULL,
        Longitude float NOT NULL,
        Latitude float NOT NULL,
        PRIMARY KEY (SID)
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo "Table Spotter created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
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
        echo "Error adding spotter: " . $conn->error;
    }
    
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
    <title>Signup form handler</title>
</head>

<body>
<!-- This page is displayed only if there is some error -->
<?php
echo nl2br($errors);
?>

</body>
</html>