<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';
include $path . "/connection/connection.php";

// Database Access Query
// if (isset($_GET['id'])) {
//     $makerValue = $_GET['id'];
// }
if(isset($_SESSION["id"])){
    $makerValue = $_SESSION["id"];
    echo "session db ".$makerValue;
}
// if (isset($_GET['usedb'])) {
//     $usedb = $_GET['usedb'];
//   }

  if (isset($_GET['usedb'])) {
    $dbnya = $_GET['usedb'];
    echo "use db ".$dbnya;
  } 

  if(isset($_SESSION["period"])){
    $period = $_SESSION["period"];
    echo "period ".$period;
}

if ($makerValue == 1){
    $DatabaseAccessQuery = "
    SELECT
        *
    FROM
    `$dbnya`.`general_log`
    WHERE event_time BETWEEN
(
SELECT period_start
FROM $dbnya.audit_period
WHERE period_id = $period
)
AND
(
SELECT period_end
FROM $dbnya.audit_period
WHERE period_id= $period
)
    ORDER BY event_time DESC
    ";
    $AccessList = $dbh->query($DatabaseAccessQuery);
}elseif ($makerValue == 2) {

    $DatabaseAccessQuery = "
    SELECT
        access_log_id [Id],
        login_name [Name],
        program_name as [Program],
        access_time as [Time]
    FROM $dbnya.[dbo].[success_access_log]
    WHERE access_time BETWEEN
(
SELECT period_start
FROM $dbnya.dbo.audit_period
WHERE period_id = $period
)
AND
(
SELECT period_end
FROM $dbnya.dbo.audit_period
WHERE period_id= $period
)
    ORDER BY [Time] desc";
$AccessList = $conn->query($DatabaseAccessQuery);
}
?>

