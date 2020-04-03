<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";
include $path.'/choose_db.php';
// Database Access Query
// include $path.'/choose_db.php';
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
        access_time as [Time],
        login_name as [Name],
        program_name as [Program]
    FROM databaseauditbikestore.dbo.success_access_log
    ORDER BY [Time] desc'; 
$AccessList = $conn->query($DatabaseAccessQuery);
    }
?>