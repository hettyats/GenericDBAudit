<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database Login Name List Query
$RoleQuery = '
SELECT principal_id,
     name,
     type_desc,
     type,
     create_date FROM databaseauditbikestore.sys.database_principals
';
$Role = $conn->query($RoleQuery);

?>
