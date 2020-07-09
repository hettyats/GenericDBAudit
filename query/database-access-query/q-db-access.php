<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database Access Query
// if (isset($_GET['id'])) {
//     $makerValue = $_GET['id'];
// }
if(isset($_SESSION["id"])){
    $makerValue = $_SESSION["id"];
    echo "session db ".$makerValue;
}
// if (isset($_GET['usedb'])) {
//     $usedb = $_GET['usedb'];
//   }

  if (isset($_GET['usedb'])) {
    $dbnya = $_GET['usedb'];
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
}elseif ($makerValue == 2) {

    $DatabaseAccessQuery = "
    SELECT
        access_log_id [Id],
        login_name [Name],
        program_name as [Program],
        access_time as [Time]
    FROM $dbnya.[dbo].[success_access_log]
    ORDER BY [Time] desc";
$AccessList = $conn->query($DatabaseAccessQuery);
}
?>

