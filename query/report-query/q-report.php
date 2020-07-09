<?php 
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";
include $path . "/pages/report/outlier-function.php";
//include $path.'/choose_db.php';
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  } 
if (isset($_GET['usedb'])) {
    $dbnya = $_GET['usedb'];
  }
// $dbnya = 'databaseaudit';
//MySQL
if ($makerValue == 1){
$databaseAccessQuery = "
  SELECT 
    DAY(event_time) AS Day,
    MONTH(event_time) AS Month,
    YEAR(event_time) AS Year,
    COUNT(event_time) AS Total,
    user_host
  FROM $dbnya.count_success_log
  WHERE Total > 400
  GROUP BY user_host
  ";
$dbAccessStmt = $dbh->query($databaseAccessQuery);

$dbAccess = array();
$accessDate = array();

while ($row = $dbAccessStmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($dbAccess, $row['Total']);
    array_push($accessDate, $row['Day'] . " " . date('F', mktime(0, 0, 0, $row['Month'], 10)) . " " . $row['Year']);
}
$outlier = findOutlier($dbAccess);



$outsideQuery = "
SELECT        
    user_host, `last_access`, `Total`
FROM `$dbnya`.`count_user_outside_operating_hour`
";
$dbOutside = $dbh->query($outsideQuery);



$notchangePassword ="
SELECT `HOST`,
  `USER`, 
  `password_expired`,
(CASE 
WHEN `password_expired` = 'Y' THEN 'Expired'
ELSE 'Not Expired'
END) AS `Status`
    FROM `$dbnya`.`user_password_expired`
    Where `password_expired` = 'Y'

";
$dbChangePW = $dbh->query($notchangePassword);



$NotActiveQuery = "
SELECT user_host, last_access FROM `$dbnya`.`inactive_user`;   
";
$NA = $dbh->query($NotActiveQuery);




} else {
//SQL Server
$databaseAccessQuery = "
select [Day]
    ,[Month]
    ,[Total]
    ,[login_name]
    ,[Year]
from
[$dbnya].[dbo].[database_access_per_day]
   
    WHERE [Total] > 400
Order by day asc
";
$dbAccessStmt = $conn->query($databaseAccessQuery);

$dbAccess = array();
$accessDate = array();

while ($row = $dbAccessStmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($dbAccess, $row['Total']);
    array_push($accessDate, $row['Day'] . " " . date('F', mktime(0, 0, 0, $row['Month'], 10)) . " " . $row['Year']);
}
$outlier = findOutlier($dbAccess);



$outsideQuery ="
SELECT
    login_name, Count (distinct(access_time)) As [Total], MAX(access_time) as [last_access]
    FROM
    [$dbnya].[dbo].[user_outside_operating_hour]
    GROUP BY login_name
";
$dbOutside = $conn->query($outsideQuery);



$notchangePassword ="
SELECT [name]
      , [principal_id]
      , [type_desc]
      , [lastsettime] = 
		Case [lastsettime]
			when [lastsettime] then [lastsettime]
			else 'Not SQL Server Login'
		END
      , [dayexpiration]
      , [passhash]
      , [passhashalgo] = 
		Case [passhashalgo]
			when 0 then 'SQL7.0'
			when 1 then 'SHA-1'
			when 2 then 'SHA-2'
			else 'Not SQL Server login'
		END
  FROM [$dbnya].[dbo].[database_user_password]
  WHERE (datediff(MM,convert(datetime,lastsettime), getdate())) > 2
";
$dbChangePW = $conn->query($notchangePassword);




$NotActiveQuery = "
SELECT  [login_name], MAX(access_time) AS last_access
        FROM [$dbnya].[dbo].[success_access_log]
        WHERE CONVERT(INT, month(getdate()), 111) -CONVERT(INT,month([access_time]), 111) > 2
		GROUP BY login_name
";
$NA = $conn->query($NotActiveQuery);

}


?>