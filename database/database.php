<?php
        
    $servername = "mysql11.000webhost.com";
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

    $conn->close();

?>