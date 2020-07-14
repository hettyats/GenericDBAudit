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
// Database User Query
if ($makerValue == 1){
    $DBUserQuery = "SELECT 
    `user_host` AS `Name`,
    MAX(`event_time`) AS `LastAccess`,
    COUNT(*) AS `Total`
    FROM `$dbnya`.`general_log`
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
    WHERE period_id = $period
    )
    GROUP BY `user_host`"
    ;
    $DBUser = $dbh->query($DBUserQuery);

    $DBUserChartQuery = "SELECT 
    `user_host` AS `Name`,
    COUNT(*) AS `Total`
    FROM `$dbnya`.`general_log`
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
    WHERE period_id = $period
    )
    GROUP BY `user_host`
    ";
    $UserChart = $dbh->query($DBUserChartQuery);
    
    $name = array();
    $total = array();

    while ($row = $UserChart->fetch(PDO::FETCH_ASSOC)) {
    array_push($total, $row['Total']);
    array_push($name, $row['Name']);
    }


} else {
    $DBUserQuery = "SELECT 
    login_name as [Name],
    count(*) as [Total]
        FROM $dbnya.dbo.success_access_log
        WHERE access_time BETWEEN
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
        GROUP BY login_name
        ";
    $DBUser = $conn->query($DBUserQuery);

    $DBUserChartQuery = "SELECT 
    login_name as [Name],
    count(*) as [Total]
        FROM $dbnya.dbo.success_access_log
        WHERE access_time BETWEEN
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
        GROUP BY login_name
        ";
    $UserChart = $conn->query($DBUserChartQuery);

    $name = array();
    $total = array();

    while ($row = $UserChart->fetch(PDO::FETCH_ASSOC)) {
    array_push($total, $row['Total']);
    array_push($name, $row['Name']);
    }

}

?>