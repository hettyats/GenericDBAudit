<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";
if (isset($_GET['user_host'])) {
  $user_host = $_GET['user_host'];
  // $err = $_GET['error_message'];
  $makerValue = $_GET['id'];
}
if(isset($_SESSION["id"])){
  $makerValue = $_SESSION["id"];
  // echo "session db ".$makerValue;
}

if (isset($_GET['usedb'])) {
$dbnya = $_GET['usedb'];
}

if(isset($_SESSION["period"])){
  $period = $_SESSION["period"];}
  
// Database Failed Login List Query
if ($makerValue == 1){
$ListErrQuery = "
SELECT
  `event_time`,
  `user_host`,
  `argument`
FROM `$dbnya`.`failed_list` 
WHERE `user_host` = '".$user_host."'
AND
event_time BETWEEN
(
SELECT period_start
FROM $dbnya.audit_period
WHERE period_id = $period
)
AND
(
SELECT period_end
FROM $dbnya.audit_period
WHERE period_id= $period
)
";
  $ListErr = $dbh->query($ListErrQuery);


} else { 

$ListErrQuery = "
SELECT [error_date],
[error_message],
[source]
FROM [$dbnya].[dbo].[error_log]
WHERE error_date BETWEEN
(
SELECT period_start
FROM $dbnya.audit_period
WHERE period_id = $period
)
AND
(
SELECT period_end
FROM $dbnya.audit_period
WHERE period_id= $period
)
";
$ListErr = $conn->query($ListErrQuery);
}
?>