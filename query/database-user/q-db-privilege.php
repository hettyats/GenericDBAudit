<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database Privilege List Query
$PrivilegeQuery = '
SELECT permission_name as PermissionName,
       type,
       state_desc,
       class_desc FROM databaseauditbikestore.sys.database_permissions
';
$Privilege = $conn->query($PrivilegeQuery);

?>
