<?php
    // Relation 'Missing': Missing Persons

    $sql = "CREATE TABLE IF NOT EXISTS Missing (
        MID int NOT NULL AUTO_INCREMENT,
        TweetURL varchar(255) NOT NULL,
        Longitude float NOT NULL,
        Latitude float NOT NULL,
        TimeCreated int,
        PRIMARY KEY (MID)
    )";

    // Relation 'Spotter': People looking out for missing persons
    // Note: SID is phone number of the spotter

    $sql = "CREATE TABLE IF NOT EXISTS Spotter (
        SID int NOT NULL,
        Longitude float NOT NULL,
        Latitude float NOT NULL,
        PRIMARY KEY (SID)
    )";

?>