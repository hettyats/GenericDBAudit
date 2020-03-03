<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

$ViewDetailQuery = '
SELECT
	ObjectID as [ObjID],
	ObjectType as [ObjType],
	ObjectName as [ObjName],
	SchemaID as [ObjSchema],
	CreateDate as [CrDate],
	ModifyDate as [ModDate],
	Definition as [ObjDef]
FROM 
	NorthwindViews
WHERE 
	[ObjectID] = '.$viewID;

$ViewDetails = $conn->query($ViewDetailQuery);

$rowView = $ViewDetails->fetch(PDO::FETCH_ASSOC);

// View Dependency List
$ViewDependencyQuery = '
SELECT
	ObjectID as ObjID,
	DatabaseObject as Obj,
	DependObjectID as DepID,
	DependObject Dep,
	DependObjectType as Type
FROM
	ObjectDependencyView
WHERE 
	ObjectID = '.$viewID;
	
$ViewDependency = $conn->query($ViewDependencyQuery);

// Count number of dependency object
$DepNumQuery = '
SELECT
	COUNT(ObjectID) as [Num]
FROM 
	ObjectDependencyView
WHERE 
	[ObjectID] = '.$viewID;

$DepNum = $conn->query($DepNumQuery);

$rowNum = $DepNum->fetch(PDO::FETCH_ASSOC);

?>