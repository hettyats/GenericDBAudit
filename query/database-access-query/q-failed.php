<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }

if ($makerValue == 1){
// Database login error List Query
$ErrorQuery = "
SELECT
`general_log`.`event_time` AS `event_time`,
`general_log`.`user_host`  AS `user_host`,
COUNT(`general_log`.`event_time`) AS `Total`
FROM `databaseaudit`.`general_log`
WHERE argument LIKE 'Access denied for user%'
GROUP BY `general_log`.`user_host`";

$Failed = $dbh->query($ErrorQuery);

$error = array();
$total = array();

while ($row = $Failed->fetch(PDO::FETCH_ASSOC)) {
array_push($total, $row['Total']);
array_push($error, $row['user_host']);
}

} else {
$ErrorQuery = "
select 
	Text as [Message],
	count as [Total],
	date as [Date]
from [databaseaudit].[dbo].[failed_login]
";
$Failed = $conn->query($ErrorQuery);

$error = array();
$total = array();

while ($row = $Failed->fetch(PDO::FETCH_ASSOC)) {
array_push($total, $row['Total']);
array_push($error, $row['Message']);
}

}
?>