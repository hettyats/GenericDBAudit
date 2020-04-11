<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }


if ($makerValue == 1){
    $PrivilegeQuery = '';
    
$Privilege = $dbh->query($PrivilegeQuery);
} else {  
// Database Privilege List Query
$PrivilegeQuery = '
SELECT DISTINCT permission_name as PermissionName,
       type,
       state_desc,
       class_desc FROM databaseauditbikestore.sys.database_permissions
';
$Privilege = $conn->query($PrivilegeQuery);
}
?>
