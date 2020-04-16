<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database Access Query
$query1 = '
SELECT [access_log_id]
      ,[spid]
      ,[login_name]
      ,[program_name]
      ,[ip_address]
      ,[access_time]
  FROM [DatabaseAudit].[dbo].[success_access_log]
  WHERE convert(date, [access_time]) = CONVERT(VARCHAR(10), getdate(), 111);
';
$stmt1 = $conn->query($query1);

// $total = array();
// $month = array();

// while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
//     array_push($total, $row['Total']);
//     array_push($month, $row['Day'] . " " . date('F', mktime(0, 0, 0, $row['Month'], 10)) . " " . $row['Year']);
//}

// Database DDL Activity Query
$query2 = '
SELECT [Day]
    ,[Month]
    ,[Year]
    ,[Total]
    ,[login_name]
from [DatabaseAudit].[dbo].[database_access_per_day]
order by Day desc
';
$stmt2 = $conn->query($query2);

?>