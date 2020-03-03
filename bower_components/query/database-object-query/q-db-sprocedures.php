<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database Access Query
$ProcedureListQuery = '
SELECT
	ObjectID as [ObjID],
	ObjectName as [ObjName],
	CreateDate as [CrDate]
FROM 
    NorthwindSProcedures
';

$ProcedureList = $conn->query($ProcedureListQuery);

?>