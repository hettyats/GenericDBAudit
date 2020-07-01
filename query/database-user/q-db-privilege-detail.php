<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";
if (isset($_GET['perm'])) {
  $permissionType = $_GET['perm'];
  $permission = $_GET['PRIVILEGE_TYPE'];
	$makerValue = $_GET['id'];
}
  
// Database Privilege List Query
if ($makerValue == 1){
$ListPrivQuery = "
SELECT 	`GRANTEE`, 
	`TABLE_CATALOG`, 
	`PRIVILEGE_TYPE`, 
	CASE `IS_GRANTABLE`
          WHEN 'YES' THEN 'GRANT'
          ELSE 'DENY'
        END AS `state_desc`
	FROM 
	`databaseaudit`.`privileges_list` 
	where `PRIVILEGE_TYPE` = '".$permission."'";
	$ListPriv = $dbh->query($ListPrivQuery);
} else { 
$ListPrivQuery = "
SELECT [UserName]
      ,[UserType]
      ,[DatabaseUserName]
      ,[Role]
      ,[PermissionState]
      ,[ObjectType]
      ,[ObjectName]
  FROM [DatabaseAudit].[dbo].[privilege_list]
where PermissionType = '".$permissionType."'";
$ListPriv = $conn->query($ListPrivQuery);
}
?>