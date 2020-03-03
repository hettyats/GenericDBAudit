<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

$TableDetailQuery = '
SELECT
	ObjectID as [ObjID],
	ObjectType as [ObjType],
	ObjectName as [ObjName],
	SchemaID as [ObjSchema],
	CreateDate as [CrDate],
	ModifyDate as [ModDate],
	Definition as [ObjDef]
FROM 
	NorthwindTables
WHERE 
	[ObjectID] = '.$tableID;

$TableDetails = $conn->query($TableDetailQuery);

$row = $TableDetails->fetch(PDO::FETCH_ASSOC);

// Table Definition  Query
$TableDefQuery = '
SELECT
	col as [Column],
	datatype as [Type],
	length as [Length],
	Nullable as [Null]
FROM 
	table_definition
WHERE 
	id = '.$tableID;
	
$TableDef = $conn->query($TableDefQuery);
?>