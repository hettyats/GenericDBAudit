<?php
$path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit';  
include $path.'/connection/database-config.php';

try {
    $dbh = new PDO("mysql:host=$host;dbname=$db", $dbuser, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
    // echo "Connected successfully";
    $conn = new PDO("sqlsrv:server=$server", $pwd);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 

}
    catch (PDOException $e) {
    die("Connection Failed");
}
