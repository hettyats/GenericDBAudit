<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database Access Query
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }

if ($makerValue == 1){
    $DatabaseAccessQuery = '
    SELECT
        *
    FROM
    `general_log`
    ORDER BY event_time DESC
    ';
    $AccessList = $dbh->query($DatabaseAccessQuery);
    } else {
    $DatabaseAccessQuery = '
    SELECT
        access_log_id [Id],
        login_name [Name],
        program_name as [Program],
        access_time as [Time]
    FROM databaseaudit.dbo.success_access_log
    ORDER BY [Time] desc';
$AccessList = $conn->query($DatabaseAccessQuery);
    }
?>
