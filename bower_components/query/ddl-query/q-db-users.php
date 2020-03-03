<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// DDL User List Query
$UserListQuery = '
SELECT 
	LoginName as [Name],
	MAX(EventDate) as [Date],
	COUNT(DISTINCT(ProgramName)) as [Program]
FROM 
	NorthwindDDLActivity
GROUP BY [LoginName]
ORDER BY [Name] ASC
';
$UserList = $conn->query($UserListQuery);


// DDL User Chart Query
$UserChartQuery = '
SELECT 
	COUNT(LoginName) as [Total],
	LoginName as [Name]
FROM 
	NorthwindDDLActivity
GROUP BY
	LoginName
';
$UserChart = $conn->query($UserChartQuery);

$total = array();
$name = array();

while ($row = $UserChart->fetch(PDO::FETCH_ASSOC)) {
	array_push($total, $row['Total']);
	array_push($name, $row['Name']);
}

?>