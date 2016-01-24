<?php

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

    $result = json_decode(exec('python tweet_search.py'), true);
    echo $result;

    foreach ($result as $tweet) {
                        
        $sql = "INSERT INTO Missing (TweetURL, Longtitude, Latitude)
        VALUES ('" . $tweet[0] . "', '" . $tweet[1] . "', '" . $tweet[2] . "')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Missing person reported successfully.";
        } else {
            echo "Error reporting missing person: " . $conn->error;
        }
    }

    
    $conn->close();

?>