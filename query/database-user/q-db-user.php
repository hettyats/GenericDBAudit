<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database Login Name List Query
$LoginNameQuery = '
SELECT name,
			 principal_id,
			 type_desc,
			 create_date,
			 modify_date,
			 authentication_type
			 FROM databaseauditbikestore.sys.database_principals
';
$LoginName = $conn->query($LoginNameQuery);

?>
