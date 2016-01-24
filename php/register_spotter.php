<?php
    
    require "../twilio-php-master/Services/Twilio.php";
        
    // ----------------------TWILIO------------------------------------
    
 
    // Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
    $AccountSid = "ACdadfc90dba80efa5925569edcc7bb13b";
    $AuthToken = "2f622c44c25755edc76f6da736feba45";
 
    // Step 3: instantiate a new Twilio Rest Client
    $client = new Services_Twilio($AccountSid, $AuthToken);



    if(empty($_GET['name'])  || 
       empty($_GET['phone']))
    {
        $errors .= "\n Error: all fields are required";
    }

    $name = $_GET['name']; 
    $phone = $_GET['phone']; 
 
    // Step 4: make an array of people we know, to send them a message. 
    // Feel free to change/add your own phone number and name here.
    $people = array(
        $phone => $name,
    );
 
    // Step 5: Loop over all our friends. $number is a phone number above, and 
    // $name is the name next to it
    foreach ($people as $phone => $name) {
 
        $sms = $client->account->messages->sendMessage(
 
        // Step 6: Change the 'From' number below to be a valid Twilio number 
        // that you've purchased, or the (deprecated) Sandbox number
            "289-796-0748", 
 
            // the number we are sending to - Any phone number
            $phone,
 
            // the sms body
            "Hey $name, Welcome to Spotter."
        );
        // Display a confirmation message on the screen
        echo "Sent message to $name.";
        echo "<br><br>";
        echo "<a href='../index.html'>Back to Spotter</a>";
        echo "<br><br>";
    }
        
        
    // ----------------------DATABASE------------------------------------
    $servername = "mysql11.000webhost.com";
    $username = "a2117997_FF";
    $password = "codepanda18";
    $dbname = "a2117997_SDB";

    // Create connection
    $conn = new mysqli($servername, $username, $password); 
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
        
    //function convAddr($addr) {
        
    /*$curl = curl_init();
    // Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/json?address='.$name.'&region=ca&key=AIzaSyDsCm6RND11bnOXGGQn1rGv-yg4U2snilc',
        CURLOPT_USERAGENT => 'Google API Request'
    ));
    // Send the request & save response to $resp
    $resp = curl_exec($curl);
    // Close request to clear up some resources
    curl_close($curl);
    $obj = json_decode($resp, true);
    print_r($obj);
    
    // https://developers.google.com/maps/documentation/geocoding/intro
    // Region Basing section
    $long = $obj['results']['location']['lng'];
    $lat = $obj['results']['location']['lat'];

    echo $long;
    echo $lat;
    echo "<br><br>";
    //return array ($long, $lat);
    //}
    */
//---------------------CURL REQUEST LAT/LONG------------------------
    $address = $_GET['address']; 
    $addrp = explode(" ", $address);
    $addr = '';
    $addrLast = end($addrp);
    foreach($addrp as $value){
        if($value == $addrLast){
            $addr .= $value;
        }
        else{
            $addr .= $value . '+';
        }
    }
    //echo $addr;
/*echo "<br><br>";
$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$addr.'&region=ca&key=AIzaSyCjl3obnErO7Pgmk_eEoqfAWzfprMGX6Xc';

    
    $cURL = curl_init();

    curl_setopt($cURL, CURLOPT_URL, $url);
    curl_setopt($cURL, CURLOPT_HTTPGET, true);

    curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Accept: application/json'
    ));

    $obj = curl_exec($cURL);

    curl_close($cURL);
    print_r($obj);
    */
    echo "<br><br>";
    //echo "Check231: ";
    $request =file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$addr."&region=ca&key=AIzaSyCjl3obnErO7Pgmk_eEoqfAWzfprMGX6Xc");

    $json = json_decode($request, true);
    //echo "Check: ";
    //echo $json['results'][0]['geometry']['location']['lng'];
    //echo $json['results'][0]['geometry'];
    //echo "<br><br>";
    //$long = $decoded['results'][0]['geometry']['location']['lng'];
    //$lat = $decoded['results'][0]['geometry']['location']['lat'];
    
    //$long = $obj['results']['location']['lng'];
    //$lat = $obj['results']['location']['lng'];
    //$tuple = array($long, $lat);
    //$results[] = $tuple;
    //echo $long;
    //echo $lat;
    //print_r($results);
    
    

    $long = $json['results'][0]['geometry']['location']['lng'];
    $lat = $json['results'][0]['geometry']['location']['lat'];

    //echo $long;
    //echo $lat;
    //echo "<br><br>";
        
    $conn->select_db( $dbname );
    $sql = "INSERT INTO Spotter (SID, Longitude, Latitude)
    VALUES ('" . $phone . "', '" . $long . "', '" . $lat . "')";
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