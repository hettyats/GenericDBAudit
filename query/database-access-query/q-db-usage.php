<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }


// Database User Query
if ($makerValue == 1){
    $DBUserQuery = '
    SELECT * 
    FROM 
    `general_log`
    ';

    $DBUser = $dbh->query($DBUserQuery);
} else {
    $DBUserQuery = '
    SELECT TOP 10
    [access_log_id],
    [spid],
    [login_name],
    [access_time]
FROM databaseauditbikestore.dbo.success_access_log';
    
    $DBUser = $conn->query($DBUserQuery);
}
// $name = array();
// $total = array();

//  while ($row = $DBUser->fetch(PDO::FETCH_ASSOC)) {
//      array_push($total, $row['Total']);
//      array_push($name, $row['Name']);
//  }
?>