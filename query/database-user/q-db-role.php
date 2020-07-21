<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

if (isset($_GET['id'])) {
     $makerValue = $_GET['id'];
   }
   if(isset($_SESSION["id"])){
     $makerValue = $_SESSION["id"];
     // echo "session db ".$makerValue;
 }
 
 if (isset($_GET['usedb'])) {
   $dbnya = $_GET['usedb'];
 }

 if(isset($_SESSION["period"])){
     $period = $_SESSION["period"];}

// Database Login Name List Query
if ($makerValue == 1){
     $RoleQuery = "
     SELECT
	`User`, 
	`HOST`, 
	`Role`,
	`Admin_option`
	 
	FROM 
	`$dbnya`.`role_list` ";
     $Role = $dbh->query($RoleQuery);
} else {   
$RoleQuery = "
SELECT principal_id,
     name,
     type_desc,
     type,
     create_date FROM $dbnya.sys.database_principals
";
$Role = $conn->query($RoleQuery);
}
?>
