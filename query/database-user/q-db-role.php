<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

if (isset($_GET['id'])) {
     $makerValue = $_GET['id'];
   }


// Database Login Name List Query
if ($makerValue == 1){
     $RoleQuery = '
     SELECT 	`Role_id`, 
	`User`, 
	`HOST`, 
	`Role`, 
	`Create_date`, 
	`Admin_option`
	 
	FROM 
	`databaseaudit`.`role_list` ';
     $Role = $dbh->query($RoleQuery);
} else {   
$RoleQuery = '
SELECT principal_id,
     name,
     type_desc,
     type,
     create_date FROM databaseaudit.sys.database_principals
';
$Role = $conn->query($RoleQuery);
}
?>
