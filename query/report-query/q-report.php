<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";
include $path . "/pages/report/outlier-function.php";
//include $path.'/choose_db.php';


// Akses basis data MySQL
if ($makerValue == 1){

$query2 = '
  SELECT *
  FROM databaseaudit.count_success_log
  WHERE Total > 400
  GROUP BY user_host
  ';
$stmt2 = $dbh->query($query2);

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

$outsideQuery = '
SELECT        user_host, MAX(`general_log`.`event_time`) AS `event_time`, COUNT(`general_log`.`event_time`) AS `Total`
FROM            `databaseaudit`.`general_log`
WHERE CONVERT(TIME(event_time), INT) < CONVERT("08:00:00", TIME) OR CONVERT(TIME(event_time), INT) > CONVERT("19:00:00", TIME)
GROUP BY `general_log`.`user_host`
';
$dbOutside = $dbh->query($outsideQuery);

$NotActiveQuery = '
SELECT * FROM inactive_user;   
';
$NA = $dbh->query($NotActiveQuery);

} else {
// Akses basis data SQL Server
$query2 = '
SELECT [Day]
    ,[Month]
    ,[Year]
    ,[Total]
    ,[login_name]
from [DatabaseAudit].[dbo].[database_access_per_day]
WHERE [Total] > 1000
order by Day desc
';
$stmt2 = $conn->query($query2);

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

$dbAccess = array();
$accessDate = array();

while ($row = $dbAccessStmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($dbAccess, $row['Total']);
    array_push($accessDate,$row['Day'] . " " . date('F', mktime(0, 0, 0, $row['Month'], 10)) . " " . $row['Year']);
}

$outlier = findOutlier($dbAccess);

$outsideQuery ='
SELECT
    login_name, Count (distinct(access_time)) As [Total], MAX(access_time) as [last_access]
    FROM
    [DatabaseAudit].[dbo].[user_outside_operating_hour]
    GROUP BY login_name
';
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
  FROM [DatabaseAudit].[dbo].[database_user_password]
  WHERE (datediff(MM,convert(datetime,lastsettime), getdate())) > 2
";
$dbChangePW = $conn->query($notchangePassword);

$NotActiveQuery = "
SELECT [login_name],[program_name],MAX(access_time) AS last_access
        FROM [DatabaseAudit].[dbo].[success_access_log]
        WHERE CONVERT(INT, month(getdate()), 111) -CONVERT(INT,month([access_time]), 111) > 2
		GROUP BY login_name, [program_name]
";
$NA = $conn->query($NotActiveQuery);


}
?>