<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

$sth = $dbh->query ("SELECT * FROM northwind.products LIMIT 2");
    printf ("Number of columns in result set: %d\n<br><br>", $sth->rowCount ());
    $count = 0;
    while ($rows = $sth->fetch (PDO::FETCH_ASSOC))
    printf ("%s Name: %s<br> Price: %s<br> Stock: %s <br><br>\n", $rows["ProductID"], $rows["ProductName"], $rows["UnitPrice"], $rows["UnitsInStock"]);

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
BikeStores.sys.server_principals
';
$LoginName = $dbh->query($LoginNameQuery);

?>