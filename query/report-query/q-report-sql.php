<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";
include $path . "/pages/report/outlier-function.php";


// Akses basis data
$databaseAccessQuery = '
select top 365
	day(access_time) as [Day],
    month(access_time) as [Month],
    year(access_time) as [Year],
    count(access_time) as [Total]
from
    databaseauditbikestore.dbo.success_access_log
group by
	year(access_time),
    month(access_time),
    day(access_time)
Order by Year asc, Month asc, day asc
';
$dbAccessStmt = $conn->query($databaseAccessQuery);

$dbAccess = array();
$accessDate = array();

while ($row = $dbAccessStmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($dbAccess, $row['Total']);
    array_push($accessDate,$row['Day'] . " " . date('F', mktime(0, 0, 0, $row['Month'], 10)) . " " . $row['Year']);
}

// $test = [1,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33];

$outlier = findOutlier($dbAccess);
// $outlier = [15,17];

// $dependencyQuery = "
// select
// 	ObjName as [Name],
// 	ObjID as [ID]
// from ViewList
// where Status = 'No'
// ";

// $dependencyStmt = $conn->query($dependencyQuery);

// $dependID = array();
// $dependName = array();

// while ($row = $dependencyStmt->fetch(PDO::FETCH_ASSOC)) {
//     array_push($dependID, $row['ID']);
//     array_push($dependName, $row['Name']);
// }


?>