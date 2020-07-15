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

if(isset($_SESSION["period"])){
  $period = $_SESSION["period"];}

if ($makerValue == 1){
    $PrivilegeQuery = "
    SELECT 	`PRIVILEGE_TYPE` AS `PermissionName`, `IS_GRANTABLE`,
        CASE `IS_GRANTABLE`
          WHEN 'YES' THEN 'GRANT'
          ELSE 'DENY'
        END AS `state_desc`
      FROM 
        `$dbnya`.`privileges` 
    ";
    
$Privilege = $dbh->query($PrivilegeQuery);
} else {  
// Database Privilege List Query
$PrivilegeQuery = "
SELECT [PermissionName]
      ,[type]
      ,[state_desc]
      ,[class_desc]
  FROM [$dbnya].[dbo].[privileges]
";
$Privilege = $conn->query($PrivilegeQuery);
}
?>
