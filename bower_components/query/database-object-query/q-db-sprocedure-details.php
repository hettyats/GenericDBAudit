<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Stored Procedure Details Query
$ProcedureDetailQuery = '
SELECT 
	ObjectID as [ID],
	ObjectType as [Type],
	ObjectName as [Name],
	SchemaID as [Schema],
	CreateDate as [CrDate],
	ModifyDate as [ModDate],
	Definition as [Def]
FROM 
	NorthwindSProcedures
WHERE 
	[ObjectID] = '.$procID;

$ProcedureDetails = $conn->query($ProcedureDetailQuery);

$rowProcedure = $ProcedureDetails->fetch(PDO::FETCH_ASSOC);

?>