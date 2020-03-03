<?php
$path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit';  
include $path.'/connection/database-config.php';
$dbh = new PDO('mysql:host=localhost', $dbuser, $password);

try {
    $sth = $dbh->query ("SELECT * FROM northwind.products LIMIT 2");
    // printf ("Number of columns in result set: %d\n<br><br>", $sth->rowCount ());
    // $count = 0;
    // while ($rows = $sth->fetch (PDO::FETCH_ASSOC))
    // printf ("%s Name: %s<br> Price: %s<br> Stock: %s <br><br>\n", $rows["ProductID"], $rows["ProductName"], $rows["UnitPrice"], $rows["UnitsInStock"]);
}
    catch (PDOException $e) {
    die("Error connecting to SQL Server");
}
