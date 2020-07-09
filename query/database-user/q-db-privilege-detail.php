<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";
if (isset($_GET['perm'])) {
  $permissionType = $_GET['perm'];
  $permission = $_GET['PRIVILEGE_TYPE'];
}

if(isset($_SESSION["id"])){
  $makerValue = $_SESSION["id"];
  // echo "session db ".$makerValue;
}

if (isset($_GET['usedb'])) {
$dbnya = $_GET['usedb'];
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
	`$dbnya`.`privileges_list` 
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
  FROM [$dbnya].[dbo].[privilege_list]
where PermissionType = '".$permissionType."'";
$ListPriv = $conn->query($ListPrivQuery);
}
?>