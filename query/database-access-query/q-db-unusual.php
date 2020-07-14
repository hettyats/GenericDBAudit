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
if (isset($_POST['period'])) {
  $period = $_POST['period'];
  $_SESSION['period']=$period;
   echo $period;
  }

// Database User Query
if ($makerValue == 1){

$query2 = " SELECT *
  FROM `$dbnya`.count_success_log
  WHERE Total > 400 AND
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
  WHERE period_id = $period
  )
  ORDER BY event_time DESC
  GROUP BY user_host
  ";
$stmt2 = $dbh->query($query2);

$querychart = 
  "SELECT *
  FROM `$dbnya`.count_success_log
  WHERE Total > 400 AND
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
  WHERE period_id = $period
  )
  GROUP BY user_host"
  ;
$accessChart = $dbh->query($querychart);

    $name = array();
    $total = array();
    $month = array();

    while ($row = $accessChart->fetch(PDO::FETCH_ASSOC)) {
    array_push($total, $row['Total']);
    array_push($name, $row['user_host']);
    array_push($month, $row['event_time']);
    }

} else {

    $query2 = " SELECT [Day]
        ,[Month]
        ,[Year]
        ,[Total]
        ,[login_name]
    from [$dbnya].[dbo].[database_access_per_day]
    WHERE [Total] > 1000
    AND access_time BETWEEN
    (
    SELECT period_start
    FROM $dbnya.dbo.audit_period
    WHERE period_id = $period
    )
    AND
    (
    SELECT period_end
    FROM $dbnya.dbo.audit_period
    WHERE period_id = $period
    )
    order by Day desc"
    ;
    $stmt2 = $conn->query($query2);

    $querychart = "SELECT [Day]
        ,[Month]
        ,[Year]
        ,[Total]
        ,[login_name]
    from [$dbnya].[dbo].[database_access_per_day]
    WHERE [Total] > 1000
    AND access_time BETWEEN
    (
    SELECT period_start
    FROM $dbnya.dbo.audit_period
    WHERE period_id = $period
    )
    AND
    (
    SELECT period_end
    FROM $dbnya.dbo.audit_period
    WHERE period_id = $period
    )
    order by Day desc";
    $accessChart = $conn->query($querychart);

    $name = array();
    $total = array();
    $month = array();

    while ($row = $accessChart->fetch(PDO::FETCH_ASSOC)) {
    array_push($total, $row['Total']);
    array_push($name, $row['login_name']);
    array_push($month,$row['Day'] . " " . date('F', mktime(0, 0, 0, $row['Month'], 10)) . " " . $row['Year']);
    }
}

?>