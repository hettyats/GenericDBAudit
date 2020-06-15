<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database Unusual Access Query
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }

if ($makerValue == 1){
    $UnusualAccessQuery = '
    SELECT
        *
    FROM
    `user_outside_operating_hour`
    ORDER BY event_time DESC
    ';
    $Unusual = $dbh->query($UnusualAccessQuery);
    } else {
    $UnusualAccessQuery = '
    SELECT
        login_name [Name],
        program_name as [Program],
        ip_address as [IP Adress],
        access_time as [Time]
    FROM databaseaudit.dbo.user_outside_operating_hour
    ORDER BY [Time] desc';
$Unusual = $conn->query($UnusualAccessQuery);
    }
?>
