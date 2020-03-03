<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database Access Query
$FunctionListQuery = '
SELECT
	ObjectID as [ObjID],
	ObjectName as [ObjName],
	CreateDate as [CrDate]
FROM 
    NorthwindFunction
';

$FunctionList = $conn->query($FunctionListQuery);

?>