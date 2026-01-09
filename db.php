<?php
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="orlia";
    
    // Enable error reporting for mysqli
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        $conn = new mysqli($servername, $username, $password, $dbname);
        $conn->set_charset("utf8mb4");
    } catch (Exception $e) {
        die("Connection failed: " . $e->getMessage());
    }
?>