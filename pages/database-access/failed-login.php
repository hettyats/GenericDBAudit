<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/pages/navbars/head.php'; 
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  } 
  if (isset($_GET['usedb'])) {
    $dbnya = $_GET['usedb'];
    // echo "masuk pak eko ".$dbnya;
  }

  if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
    $_SESSION['id']=$makerValue;
    // echo "masuk pak eko ".$makerValue;
}
  ?>

<?php include $path.'/query/database-access-query/q-db-loginerror.php'; ?>
<div class="wrapper">

    <?php include $path.'/pages/navbars/top-navbar.php'; ?>
    <?php include $path.'/pages/navbars/left-sidebar.php'; ?>

    <!-- HEADER and BREADCRUMB -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Database Failed Login: <?php echo substr($dbnya,0,-5)?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/TA2/DBAudit/index.php"><i class="fa fa-dashboard"></i>Home</a></li>
                <li><a href="/TA2/DBAudit/pages/database-access/failed-login.php?id=<?php echo $makerValue ?>&usedb=<?php echo $dbnya?>">Database Access</a></li>
                <li class='active'>Failed Login</a></li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

        <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">Failed Login Chart</h3>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="failedChart" style="height:230px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">Failed Login List</h3>
                        </div>
                        <div class="box-body">
                            <table id="FailedList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                    <?php if ($makerValue == 1) {?>
                                        <th>Host</th>
                                        <th>Last Access Time</th>
                                        <th>Total</th>
                                        <th>More</th>
                                        <?php } else{ ?>
                                        <th>Error Message</th>
                                        <th>Total of Error</th>
                                        <th>Last Error Date</th>
                                        <th>More</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody method="get">
                                    <?php while ($row = $Error->fetch(PDO::FETCH_ASSOC)) {?>
                                      <tr  method="POST">
                                        <?php if ($makerValue == 1) {?>
                                    <tr>
                                    <td value=<?php echo $row['user_host'] ?> ><?php echo $row['user_host'] ?></td>
                                    <!-- <td><?php //echo ($row['user_host']);?></td> -->
                                    <td><?php echo $row['event_time']?></td>
                                    <td><?php echo $row['Total']?></td>
                                        <td>
                                            <a method="get" href="/TA2/DBAudit/pages/database-access/failed-detail.php?user_host=<?php echo $row['user_host']?>&id=<?php echo $makerValue?>?id=<?php echo $makerValue ?>&usedb=<?php echo $dbnya?>"
                                                class="text-muted">
                                                <i class="fa fa-search"></i>
                                            </a>
                                          </td>
                                    <?php } else{ ?>
                                    <td value=<?php echo $row['error_message']?> ><?php echo $row['error_message'] ?></td>
                                    <td><?php echo $row['Total']?></td>
                                    <td><?php echo $row['Date']?></td>
                                    <td>
                                            <a method="get" href="/TA2/DBAudit/pages/database-access/failed-detail.php?error_message=<?php echo $row['error_message']?>&id=<?php echo $makerValue?>?id=<?php echo $makerValue ?>&usedb=<?php echo $dbnya?>"
                                                class="text-muted">
                                                <i class="fa fa-search"></i>
                                            </a>
                                          </td>
                                        <?php } ?>
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

    <?php include $path.'/pages/navbars/required-scripts.php'; ?>

<!-- SlimScroll -->
<script src="/TA2/DBAudit/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/TA2/DBAudit/bower_components/fastclick/lib/fastclick.js"></script>

<?php include $path.'/charts/db-access-charts/failed-charts.php'; ?>

<?php include $path.'/pages/navbars/end.php'; ?>