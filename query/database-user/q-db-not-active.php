<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database User Not-Active Query
$NotActiveQuery = "
SELECT [principal_id]
      ,[name]
      ,[type_desc]
      ,[lastsettime]
      ,[dayexpiration]
      ,[passhash]
      ,[passhashalgo]
  FROM [DatabaseAudit].[dbo].[database_user_password]
";
$NA = $conn->query($NotActiveQuery);

?>