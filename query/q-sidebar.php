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

if(isset($_SESSION["period"])){
  $period = $_SESSION["period"];
  // echo "period ".$period;
}

if ($makerValue == 1){

  $UsageNotifQuery = "SELECT 
    count(user_host) as NotifUser
    FROM `$dbnya`.`count_success_log`
    WHERE Total > 400 AND
    event_time BETWEEN
    (
    SELECT period_start
    FROM $dbnya.audit_period
    WHERE period_id = $period
    )
    AND
    (
    SELECT period_end
    FROM $dbnya.audit_period
    WHERE period_id = $period
    )
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
  
  $AccessNotifQuery = "SELECT
    Total as NotifAccess
  from `$dbnya`.`count_user_outside_operating_hour`
  WHERE
  event_time BETWEEN
  (
  SELECT period_start
  FROM $dbnya.audit_period
  WHERE period_id = $period
  )
  AND
  (
  SELECT period_end
  FROM $dbnya.audit_period
  WHERE period_id = $period
  )
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

$UsageNotifQuery = "SELECT
	count(login_name) as [NotifUser]
from $dbnya.[dbo].[database_access_per_day]
WHERE Total > 1000 AND access_time BETWEEN
(
SELECT period_start
FROM $dbnya.dbo.audit_period
WHERE period_id = $period
)
AND
(
SELECT period_end
FROM $dbnya.dbo.audit_period
WHERE period_id = $period
)
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

$AccessNotifQuery = "SELECT
Count (distinct(access_time)) as [NotifAccess]
from $dbnya.[dbo].[user_outside_operating_hour]
WHERE access_time BETWEEN
(
SELECT period_start
FROM $dbnya.dbo.audit_period
WHERE period_id = $period
)
AND
(
SELECT period_end
FROM $dbnya.dbo.audit_period
WHERE period_id= $period
)
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