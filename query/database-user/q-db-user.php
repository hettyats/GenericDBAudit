<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database Login Name List Query
$LoginNameQuery = '
SELECT
name,
principal_id,
type_desc,
is_disabled,
create_date,
modify_date
FROM
Northwind.dbo.region
';
$LoginName = $dbh->query($LoginNameQuery);

?>