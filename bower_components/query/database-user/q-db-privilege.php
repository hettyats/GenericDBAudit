<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database Privilege List Query
$PrivilegeQuery = '
SELECT 
	PermissionType
	,[User] = count(distinct(UserName))
	,[UserType] = count(distinct(UserType))
FROM [TEST - PrivilegeList]
where PermissionType IS NOT NULL
group by 
	PermissionType
';
$Privilege = $conn->query($PrivilegeQuery);

?>