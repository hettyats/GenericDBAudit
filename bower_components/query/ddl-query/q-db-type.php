<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// DDL Type List Query
$TypeListQuery = '
SELECT 
	EventType as [Type],
	Count(EventType) as [Total],
	MAX(EventDate) as [Date],
	COUNT(DISTINCT(ObjectName)) as [Object],
	COUNT(DISTINCT(LoginName)) as [Name]
FROM 
	NorthwindDDLActivity
GROUP BY EventType
';
$TypeList = $conn->query($TypeListQuery);


// DDL Type Chart Query
$TypeChartQuery = '
SELECT 
	EventType as [Type],
	COUNT(EventType) as [Total]
FROM 
	NorthwindDDLActivity
GROUP BY
	EventType
';
$TypeChart = $conn->query($TypeChartQuery);

$total = array();
$type = array();

while ($row = $TypeChart->fetch(PDO::FETCH_ASSOC)) {
	array_push($total, $row['Total']);
	array_push($type, $row['Type']);
}

?>