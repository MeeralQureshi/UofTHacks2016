<html>
    <body>
<?php
    echo "TESTES";
    echo $_GET["name"];
    echo $_GET["phone"];
    echo $_GET["address"];
    echo $_GET["city"];
    echo $_GET["state"];
        
    $conn = //PLACEHOLDER FOR WEBHOST DB CONNECTION;
    
    $sql = "INSERT INTO Spotter (SID, Longitude, Latitude)
    VALUES ()";

?>
    </body>
    
</html>