<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Trigger Details Query
$TriggerDetailQuery = '
SELECT 
	ObjectID as [ID],
	ObjectType as [Type],
	ObjectName as [Name],
	CASE
		WHEN SchemaID IS NULL THEN 0
		ELSE SchemaID
	END as [Schema],
	CreateDate as [CrDate],
	ModifyDate as [ModDate],
	Definition as [Def]
FROM 
	NorthwindTriggers
WHERE 
	[ObjectID] = '.$triggerID;

$TriggerDetails = $conn->query($TriggerDetailQuery);

$rowTrigger = $TriggerDetails->fetch(PDO::FETCH_ASSOC);

?>