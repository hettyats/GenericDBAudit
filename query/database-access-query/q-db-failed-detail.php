<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";
if (isset($_GET['user_host'])) {
  $user_host = $_GET['user_host'];
	$makerValue = $_GET['id'];
}
  
// Database Failed Login List Query
if ($makerValue == 1){
$ListErrQuery = "
SELECT
  `event_time`,
  `user_host`,
  `argument`
FROM `databaseaudit`.`failed_list` 
WHERE `user_host` = '".$user_host."'";
  $ListErr = $dbh->query($ListErrQuery);


} else { 

$ListErrQuery = "
SELECT [error_date],
[error_message],
[source]
FROM [DatabaseAudit].[dbo].[error_log]";
$ListErr = $conn->query($ListErrQuery);
}
?>