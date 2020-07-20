<?php session_start();
 if(!isset($_SESSION["user"])) header("Location: login.php");
?>
<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/pages/navbars/head.php'; ?>
<?php 
if (isset($_GET['usedb'])) {
        $dbnya = $_GET['usedb'];
      }
if (isset($_SESSION['period'])) {
$period = $_SESSION['period'];
}

?>
<?php include $path.'/query/q-index.php';?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Database Audit Tool</title>
</head>
<div class="wrapper">

    <?php include $path.'/pages/navbars/top-navbar.php'; ?>
    <?php include $path.'/pages/navbars/left-sidebar.php'; ?>

    <!-- HEADER and BREADCRUMB -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Database Audit: <?php echo substr($dbnya,0,-5)?>
                <!-- <small>Optional description</small> -->
            </h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i>Home</li>
                <!-- <li class="active">Here</li> -->
            </ol>
        </section>

        <!-- Main content -->
        

            <!-- DATABASE ACCESS -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-solid">
                        <div class="box-header">
                            <h3 class="box-title">Database Access Today</h3>
                            <div class="box-tools pull-right">
                                <a href="/TA2/DBAudit/pages/database-access/database-access.php?id=<?php echo $makerValue?>&usedb=<?php echo $dbnya?>&period=<?php echo $period?>">View Detail</a>
                            </div>
                        </div>
                        <div class="box-body">
                            <!-- <div class="chart">
                                <canvas id="accessChart" style="height:250px"></canvas>
                            </div> -->
                            <table id="TodayAccess" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                    <?php if ($makerValue == 1) {?>
                                        <th>Access Time</th>
                                        <th>User Host</th>
                                        <th>Command Type</th>
                                        <?php } else{ ?>
                                        <th>Username</th>
                                        <th>SPID</th>
                                        <th>Program Name</th>
                                        <th>Access Time</th>
                                        <!-- <th>Logon Time</th>
                                        <th>spid</th> -->
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {?>
                                    <tr>
                                    <?php if ($makerValue == 1) {?>
                                      <td><?php echo $row['event_time'] ?></td>
                                      <td><?php echo $row['user_host'] ?></td>
                                      <td><?php echo $row['command_type'] ?></td>
                                      <?php } else{ ?>
                                      <td><?php echo $row['login_name'] ?></td>
                                      <td><?php echo $row['spid'] ?></td>
                                      <td><?php echo $row['program_name'] ?></td>
                                      <td><?php echo $row['access_time'] ?></td>
                                      <!-- <td><?php //echo $row['access_time'] ?></td>
                                      <td><?php //echo $row['spid'] ?></td> -->
                                      <?php }?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="box box-solid">         
                        <div class="box-header">
                            <h3 class="box-title">Database Access Per Day Chart</h3>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="indexChart" style="height:230px"></canvas>
                            </div>
                        </div>
                    </div>
    
                        <div class="box box-solid">
                            <div class="box-header">
                                <h3 class="box-title">Database Access perday</h3>
                            </div>
                            <div class="box-body">
                            <table id="AccessList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <?php //if ($makerValue == 1) {?>
                                        <th>Date</th>
                                        <th>Username</th>
                                        <th>Total</th>
                                        <?php //} else{ ?>
                                          
                                        <!-- <th>More</th> -->
                                        <?php //}?>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                        if ($makerValue == 1) {?>
                                        <tr>
                                        <td><?php echo ($row['event_time'])?> </td>
                                        <td><?php echo ($row['user_host'])?></td>
                                        <td><?php echo ($row['Total'])?></td>
                                      <?php } else{ ?>
                                        <td><?php echo ($row['Day'] . " " . date('F', mktime(0, 0, 0, $row['Month'], 10)) . " " . $row['Year']) ?></td>
                                        <td><?php echo ($row['login_name'])?></td>
                                        <td><?php echo ($row['Total'])?></td>
                                      <?php }?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include $path.'/pages/navbars/footer.php'; ?>
    <?php //include $path.'/pages/navbars/control-sidebar.php'; ?>

</div>
<!-- ./wrapper -->

<?php include $path.'/pages/navbars/required-scripts.php'; ?>

<!-- CHARTS -->
<?php include $path.'/charts/index-charts/index-charts.php'; ?>

<!-- DATA TABLES -->
<script src="/TA2/DBAudit/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/TA2/DBAudit/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
$(function() {
    $('#TodayAccess').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': true
    })
})
</script>


<script>
$(function() {
    $('#AccessList').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': true
    })
})
</script>

<?php include $path.'/pages/navbars/end.php'; ?>


<?php include $path.'/charts/db-access-charts/index-charts.php'; ?>
