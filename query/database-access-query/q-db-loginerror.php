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

if(isset($_SESSION["period"])){
  $period = $_SESSION["period"];}

if ($makerValue == 1){
// Database login error List Query
$ErrorQuery = "
SELECT
        *
    FROM
    `$dbnya`.`failed_login`
    WHERE event_time BETWEEN
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

$Error = $dbh->query($ErrorQuery);

$ErrorChartQuery = "
SELECT
        *
    FROM
    `$dbnya`.`failed_login`
    WHERE event_time BETWEEN
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
)";

$ErrorChart = $dbh->query($ErrorChartQuery);

$name = array();
$total = array();

    while ($row = $ErrorChart->fetch(PDO::FETCH_ASSOC)) {
    array_push($total, $row['Total']);
    array_push($name, $row['user_host']);
    }

} else {
  $ErrorQuery =
  "SELECT 
    *
  from [$dbnya].[dbo].[error_log]
  WHERE error_date BETWEEN
(
SELECT period_start
FROM $dbnya.dbo.audit_period
WHERE period_id = $period
)
AND
(
SELECT period_end
FROM $dbnya.dbo.audit_period
WHERE period_id= $period
)";
  $Error = $conn->query($ErrorQuery);
  
  $ErrorChartQuery =
"select 
	Text as [error_message],
  count as [Total],
  date as [Date]
from [$dbnya].[dbo].[failed_login]
WHERE date BETWEEN
(
SELECT period_start
FROM $dbnya.dbo.audit_period
WHERE period_id = $period
)
AND
(
SELECT period_end
FROM $dbnya.dbo.audit_period
WHERE period_id= $period
)";
$ErrorChart = $conn->query($ErrorChartQuery);

$name = array();
$total = array();

    while ($row = $ErrorChart->fetch(PDO::FETCH_ASSOC)) {
    array_push($total, $row['Total']);
    array_push($name, $row['Date']);
    }
}
?>