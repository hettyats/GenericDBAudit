<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }


// Database User Query
if ($makerValue == 1){

$query2 = '
  SELECT *
  FROM databaseaudit.count_success_log
  WHERE Total > 400
  GROUP BY user_host
  ';
$stmt2 = $dbh->query($query2);

    $name = array();
    $total = array();
    $month = array();

    while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    array_push($total, $row['Total']);
    array_push($name, $row['user_host']);
    array_push($month, $row['event_time']);
    }

} else {

    $query2 = '
    SELECT [Day]
        ,[Month]
        ,[Year]
        ,[Total]
        ,[login_name]
    from [DatabaseAudit].[dbo].[database_access_per_day]
    WHERE [Total] > 1000
    order by Day desc
    ';
    $stmt2 = $conn->query($query2);

    $name = array();
    $total = array();
    $month = array();

    while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    array_push($total, $row['Total']);
    array_push($name, $row['login_name']);
    array_push($month,$row['Day'] . " " . date('F', mktime(0, 0, 0, $row['Month'], 10)) . " " . $row['Year']);
    }
}

?>