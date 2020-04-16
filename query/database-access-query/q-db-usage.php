<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }


// Database User Query
if ($makerValue == 1){
    $DBUserQuery = '
    SELECT 
    `user_host` AS `Name`,
    MAX(`event_time`) AS `LastAccess`,
    COUNT(*) AS `Total`
    FROM `databaseaudit`.`general_log`
    GROUP BY `user_host`
    ';
    $DBUser = $dbh->query($DBUserQuery);
} else {
    $DBUserQuery = '
    SELECT 
    login_name as [Name],
    count(*) as [Total]
FROM databaseaudit.dbo.success_access_log
GROUP BY login_name
';
    $DBUser = $conn->query($DBUserQuery);
}
// $name = array();
// $total = array();

//  while ($row = $DBUser->fetch(PDO::FETCH_ASSOC)) {
//      array_push($total, $row['Total']);
//      array_push($name, $row['Name']);
//  }
?>