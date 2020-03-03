<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database User Query
$DBUserQuery = '
SELECT
	LoginName as [Name],
	count(*) as [Total]
FROM DatabaseAccessLog
GROUP BY LoginName
';
$DBUser = $conn->query($DBUserQuery);

$name = array();
$total = array();

while ($row = $DBUser->fetch(PDO::FETCH_ASSOC)) {
    array_push($total, $row['Total']);
    array_push($name, $row['Name']);
}
?>