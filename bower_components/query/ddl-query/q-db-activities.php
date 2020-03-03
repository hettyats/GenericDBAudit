<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// DDL Activity List Query
$ActivityListQuery = '
SELECT 
	EventDate as [Date],
	EventType as [Type],
	LoginName as [Name]
FROM 
	NorthwindDDLActivity
ORDER BY [Date] DESC
';
$ActivityList = $conn->query($ActivityListQuery);


// DDL Activity Chart Query
$ActivityChartQuery = '
SELECT 
	MONTH(EventDate) as [Month],
	YEAR(EventDate) as [Year],
	COUNT(EventDate) as [Total]
FROM 
	NorthwindDDLActivity
GROUP BY
	YEAR(EventDate),
	MONTH(EventDate)
';
$ActivityChart = $conn->query($ActivityChartQuery);

$total = array();
$month = array();

while ($row = $ActivityChart->fetch(PDO::FETCH_ASSOC)) {
    array_push($total, $row['Total']);
    array_push($month, date('F', mktime(0, 0, 0, $row['Month'], 10)) . " " . $row['Year']);
}

?>