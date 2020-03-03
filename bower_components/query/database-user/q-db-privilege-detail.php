<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database Privilege List Query
$PrivilegeQuery = "
select 
	UserName as [Login]
	, UserType as [Type]
	, DatabaseUserName as [User]
	, PermissionState as [State]
	, ObjectType as [ObjType]
	, ObjectName as [Obj]
from [TEST - PrivilegeList]
where PermissionType = '".$permissionType."'";
$Privilege = $conn->query($PrivilegeQuery);

?>