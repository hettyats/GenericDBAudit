<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }

if ($makerValue == 1){
    $PrivilegeQuery = "
    SELECT 	`PRIVILEGE_TYPE` AS `PermissionName`, 
        CASE `IS_GRANTABLE`
          WHEN 'YES' THEN 'GRANT'
          ELSE 'DENY'
        END AS `state_desc`
      FROM 
        `databaseaudit`.`privileges` 
    ";
    
$Privilege = $dbh->query($PrivilegeQuery);
} else {  
// Database Privilege List Query
$PrivilegeQuery = '
SELECT [PermissionName]
      ,[type]
      ,[state_desc]
      ,[class_desc]
  FROM [DatabaseAudit].[dbo].[privileges]
';
$Privilege = $conn->query($PrivilegeQuery);
}
?>
