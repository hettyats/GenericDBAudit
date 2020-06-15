<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }

if ($makerValue == 1){
// Database login error List Query
$ErrorQuery = 'SELECT
*
FROM
`count_failed_login`
ORDER BY event_time DESC
';

$Error = $dbh->query($ErrorQuery);
} else {
$ErrorQuery = "
select 
	Text as [Message],
	count as [Total],
	date as [Date]
from [databaseaudit].[dbo].[failed_login]
";
$Error = $conn->query($ErrorQuery);
}
?>