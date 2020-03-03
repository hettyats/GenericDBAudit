<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database Access Query
$DatabaseAccessQuery = '
SELECT
	AccessTime as [Time],
	LoginName as [Name],
	ProgramName as [Program]
FROM DatabaseAccessLog
ORDER BY [Time] desc
';
$AccessList = $conn->query($DatabaseAccessQuery);

?>