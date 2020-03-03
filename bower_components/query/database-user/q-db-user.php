<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database Login Name List Query
$LoginNameQuery = '
SELECT 
	LN.LoginName as [Name],
	LN.principal_id as [ID],
	LN.type_desc as [Type],
	LN.[Status],
	LAT.diff as [Month]
FROM
	[TEST - LoginName] AS LN
INNER JOIN
	[TEST - LastAccessTime] AS LAT
ON LN.LoginName = LAT.name
ORDER BY 
	[Name] ASC
';
$LoginName = $conn->query($LoginNameQuery);

?>