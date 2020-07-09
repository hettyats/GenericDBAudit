<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }
  if(isset($_SESSION["id"])){
    $makerValue = $_SESSION["id"];
    // echo "session db ".$makerValue;
}

if (isset($_GET['usedb'])) {
  $dbnya = $_GET['usedb'];
}
if ($makerValue == 1){
// Database login error List Query
$ErrorQuery = "
SELECT
  `general_log`.`event_time` AS `event_time`,
  `general_log`.`user_host`  AS `user_host`,
  COUNT(`general_log`.`event_time`) AS `Total`
FROM `$dbnya`.`general_log`
WHERE argument LIKE 'Access denied for user%'
GROUP BY `general_log`.`user_host`";

$Error = $dbh->query($ErrorQuery);

$ErrorChartQuery = "
SELECT
  `general_log`.`user_host`  AS `user_host`,
  COUNT(`general_log`.`event_time`) AS `Total`
FROM `$dbnya`.`general_log`
WHERE argument LIKE 'Access denied for user%'
GROUP BY `general_log`.`user_host`";

$ErrorChart = $dbh->query($ErrorChartQuery);

$name = array();
$total = array();

    while ($row = $ErrorChart->fetch(PDO::FETCH_ASSOC)) {
    array_push($total, $row['Total']);
    array_push($name, $row['user_host']);
    }

} else {
  $ErrorQuery =
  "select 
    Text as [error_message],
    count as [Total],
    date as [Date]
  from [$dbnya].[dbo].[failed_login]";
  $Error = $conn->query($ErrorQuery);
  
  $ErrorChartQuery =
"select 
	Text as [error_message],
  count as [Total],
  date as [Date]
from [$dbnya].[dbo].[failed_login]";
$ErrorChart = $conn->query($ErrorChartQuery);

$name = array();
$total = array();

    while ($row = $ErrorChart->fetch(PDO::FETCH_ASSOC)) {
    array_push($total, $row['Total']);
    array_push($name, $row['Date']);
    }
}
?>