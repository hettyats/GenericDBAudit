<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Function Details Query
$FunctionDetailQuery = '
SELECT 
	ObjectID as [ID],
	ObjectType as [Type],
	ObjectName as [Name],
	SchemaID as [Schema],
	CreateDate as [CrDate],
	ModifyDate as [ModDate],
	Definition as [Def]
FROM 
	NorthwindFunction
WHERE 
	[ObjectID] = '.$functionID;

$FunctionDetails = $conn->query($FunctionDetailQuery);

$rowFunction = $FunctionDetails->fetch(PDO::FETCH_ASSOC);

?>