<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database User Password List Query
$PassQuery = "
SELECT [LoginName]
      ,[principal_id]
      ,[type_desc]
      ,[lastsettime] = 
		Case [lastsettime]
			when [lastsettime] then [lastsettime]
			else 'Not SQL Server Login'
		END
      ,[dayexpiration]
      ,[passhash]
      ,[passhashalgo] = 
		Case [passhashalgo]
			when 0 then 'SQL7.0'
			when 1 then 'SHA-1'
			when 2 then 'SHA-2'
			else 'Not SQL Server login'
		END
  FROM [TEST - UserPassword]
";
$Pass = $conn->query($PassQuery);

?>