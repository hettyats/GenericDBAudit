<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }
if(isset($_SESSION["id"])){
    $makerValue = $_SESSION["id"];
    // echo "session db ".$makerValue;
}

if (isset($_GET['usedb'])) {
  $dbnya = $_GET['usedb'];
} 

if(isset($_SESSION["period"])){
  $period = $_SESSION["period"];}
// Database User Password List Query
if ($makerValue == 1){
  $PassQuery = "SELECT DISTINCT
  `USER` as us, 
  `password_expired`,
(CASE 
WHEN `password_expired` = 'Y' THEN 'Expired'
ELSE 'Not Expired'
END) AS `Status`
    FROM `$dbnya`.`user_password_expired`
  ";
  $Pass = $dbh->query($PassQuery);

} else{
$PassQuery = "SELECT [name]
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
";
$Pass = $conn->query($PassQuery);
}
?>