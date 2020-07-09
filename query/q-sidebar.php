<?php
$path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit';
include $path . "/connection/connection.php";
if(isset($_SESSION["id"])){
    $makerValue = $_SESSION["id"];
    // echo "session db ".$makerValue;
}

if (isset($_GET['usedb'])) {
  $dbnya = $_GET['usedb'];
}

if ($makerValue == 1){

  $UsageNotifQuery = "
  SELECT 
    count(user_host) as NotifUser
    FROM `$dbnya`.`count_success_log`
    WHERE Total > 400
  ";
  $UserNotif = $dbh->query($UsageNotifQuery);
  $userNotif = $UserNotif->fetch(PDO::FETCH_ASSOC);
  
  $UserListNotifQuery = "
  select
    count(username) as NotifUserList
  from `$dbnya`.`user_list`
  WHERE username IS NULL
  ";
  $UserListNotif = $dbh->query($UserListNotifQuery);
  $userlistNotif = $UserListNotif->fetch(PDO::FETCH_ASSOC);
  
  $AccessNotifQuery = "
  select
    Total as NotifAccess
  from `$dbnya`.`count_user_outside_operating_hour`
  ";
  $AccessNotif = $dbh->query($AccessNotifQuery);
  $accessnotif = $AccessNotif->fetch(PDO::FETCH_ASSOC);
  
  $PasswordNotifQuery = "
  SELECT COUNT(DISTINCT(`USER`))
    as NotifPassword
  from `$dbnya`.`user_password_expired`
  WHERE `password_expired` = 'Y'
  ";
  $PasswordNotif = $dbh->query($PasswordNotifQuery);
  $passwordnotif = $PasswordNotif->fetch(PDO::FETCH_ASSOC);

} else {

$UsageNotifQuery = "
select
	count(login_name) as [NotifUser]
from $dbnya.[dbo].[database_access_per_day]
WHERE Total > 1000
";
$UserNotif = $conn->query($UsageNotifQuery);
$userNotif = $UserNotif->fetch(PDO::FETCH_ASSOC);

$UserListNotifQuery = "
select
	count(name) as [NotifUserList]
from $dbnya.[dbo].[database_user]
WHERE status = 'Deactivated'
";
$UserListNotif = $conn->query($UserListNotifQuery);
$userlistNotif = $UserListNotif->fetch(PDO::FETCH_ASSOC);

$AccessNotifQuery = "
select
Count (distinct(access_time)) as [NotifAccess]
from $dbnya.[dbo].[user_outside_operating_hour]
";
$AccessNotif = $conn->query($AccessNotifQuery);
$accessnotif = $AccessNotif->fetch(PDO::FETCH_ASSOC);

$PasswordNotifQuery = "
select
	count(name) as [NotifPassword]
from $dbnya.[dbo].[database_user_password]
WHERE (datediff(MM,convert(datetime,lastsettime), getdate())) > 2
";
$PasswordNotif = $conn->query($PasswordNotifQuery);
$passwordnotif = $PasswordNotif->fetch(PDO::FETCH_ASSOC);
}
?>