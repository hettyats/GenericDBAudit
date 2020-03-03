<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database Login Name List Query
$RoleQuery = '
SELECT [name]
      ,[principal_id]
      ,[type_desc]
      ,[create_date]
  FROM [TEST - Roles]
';
$Role = $conn->query($RoleQuery);

?>