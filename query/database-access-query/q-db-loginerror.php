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

$Error = $dbh->query($ErrorQuery);

} else {
$ErrorQuery = '
select 
	Text as [error_message],
	count as [Total],
	date as [Date]
from [DatabaseAudit].[dbo].[failed_login]
';
$Error = $conn->query($ErrorQuery);
}
?>