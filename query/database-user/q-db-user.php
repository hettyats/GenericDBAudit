<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }

if ($makerValue == 1){
// Database Login Name List Query
$DatabaseAccessQuery = '
SELECT * 
FROM 
`user_list`
ORDER BY `username` ASC
';
$LoginName = $dbh->query($DatabaseAccessQuery);

} else {
$LoginNameQuery = '
SELECT TOP 1000 [principal_id]
      ,[name]
      ,[type_desc]
      ,[status]
      ,[create_date]
      ,[modify_date]
      ,[last_access]
      ,[duration]
  FROM [DatabaseAudit].[dbo].[database_user]
';
$LoginName = $conn->query($LoginNameQuery);
    }	
?>
