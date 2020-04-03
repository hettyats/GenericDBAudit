<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database login error List Query
$ErrorQuery = "
select 
	Text as [Message],
	count as [Total],
	date as [Date]
from [TEST - Failed Login]
";
$Error = $conn->query($ErrorQuery);

?>