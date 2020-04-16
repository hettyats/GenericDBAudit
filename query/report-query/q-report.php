<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";
include $path . "/pages/report/outlier-function.php";
//include $path.'/choose_db.php';


// Akses basis data MySQL
if ($makerValue == 1){
$databaseAccessQuery = '
SELECT 
	DAY(event_time) AS Day,
    MONTH(event_time) AS Month,
    YEAR(event_time) AS Year,
    COUNT(event_time) AS Total
FROM
    `general_log`
group by
	year(event_time),
    month(event_time),
    day(event_time)
Order by Year asc, Month asc, day asc
';
$dbAccessStmt = $dbh->query($databaseAccessQuery);
} else {
// Akses basis data SQL Server
$databaseAccessQuery = '
select top 365
	day(access_time) as [Day],
    month(access_time) as [Month],
    year(access_time) as [Year],
    count(access_time) as [Total]
from
    databaseaudit.dbo.success_access_log
group by
	year(access_time),
    month(access_time),
    day(access_time)
Order by Year asc, Month asc, day asc
';
$dbAccessStmt = $conn->query($databaseAccessQuery);
}
$dbAccess = array();
$accessDate = array();

while ($row = $dbAccessStmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($dbAccess, $row['Total']);
    array_push($accessDate,$row['Day'] . " " . date('F', mktime(0, 0, 0, $row['Month'], 10)) . " " . $row['Year']);
}


// $test = [1,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33,33];

$outlier = findOutlier($dbAccess);

?>