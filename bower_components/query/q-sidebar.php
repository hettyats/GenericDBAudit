<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// View Notification
$ViewNotifQuery = "
select
	count(ObjID) as [NotifView]
from ViewList
where Status='No'
";
$ViewNotif = $conn->query($ViewNotifQuery);
$viewNotif = $ViewNotif->fetch(PDO::FETCH_ASSOC);
?>