<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database Access Query
$ViewListQuery = "
select 
distinct(a.ObjectName) as [ObjName],
a.ObjectID as [ObjID], 
a.CreateDate as [CrDate],
CASE
	WHEN b.ObjectID IS NULL THEN 'No'
	ELSE 'Ok'
END AS 'Status'
from NorthwindViews as a
left join ObjectDependencyView as b
on a.ObjectID=b.ObjectID
";
$ViewList = $conn->query($ViewListQuery);

?>