<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database Trigger Query
$TriggerListQuery = '
SELECT
	ObjectID as [ObjID],
	ObjectName as [ObjName],
	CreateDate as [CrDate]
FROM 
    NorthwindTriggers
';
$TriggerList = $conn->query($TriggerListQuery);

?>