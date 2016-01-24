<?php



//SQL QUERY FINDS AND SENDS MSG TO USERS IN THE RADIUS
//CALL THIS PHP WHEN A NEW TWEET IS ENTERED









    
    require "../twilio-php-master/Services/Twilio.php";
        
    // ----------------------TWILIO------------------------------------
    
 
    // Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
    $AccountSid = "ACdadfc90dba80efa5925569edcc7bb13b";
    $AuthToken = "2f622c44c25755edc76f6da736feba45";
 
    // Step 3: instantiate a new Twilio Rest Client
    $client = new Services_Twilio($AccountSid, $AuthToken);
        
        
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
        
    $sql = "SELECT s.SID
            FROM Spotter s, Missing m
            WHERE 
            ( POW((POW(ABS(m.Latitude-s.Latitude),2) - 
                   POW(ABS(m.Longitude-s.Longitude),2)), 0.5) < 50 )";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            //SEND TWILIO
            $sms = $client->account->messages->sendMessage(
            "289-796-0748", 
            $row["SID"],
            "TESTING");
        }
    } else {
        echo "0 results";
    }
    $conn->close();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
    <title>Hi</title>
</head>

<body>
</body>
</html>