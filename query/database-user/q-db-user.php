<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }

if ($makerValue == 1){
// Database Login Name List Query
$DatabaseAccessQuery = '
SELECT * 
FROM 
`user_list`
ORDER BY USER ASC
';
$LoginName = $dbh->query($DatabaseAccessQuery);

} else {
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
    }	
?>
