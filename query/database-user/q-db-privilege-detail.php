<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";
if (isset($_GET['perm'])) {
    $permissionType = $_GET['perm'];}
  
// Database Privilege List Query
$PrivilegeQuery = "
select 
	UserName as [Login]
	, UserType as [Type]
	, DatabaseUserName as [User]
	, PermissionState as [State]
	, ObjectType as [ObjType]
	, ObjectName as [Obj] 
from databaseauditbikestore.sys.database_permissions
where PermissionType = '".$permissionType."'";//cari tau dlu dmana itu disimpan
$Privilege = $conn->query($PrivilegeQuery);

?>