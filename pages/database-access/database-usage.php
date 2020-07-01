<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/pages/navbars/head.php'; 
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  } ?>
<?php include $path.'/query/database-access-query/q-db-usage.php'; ?>

<div class="wrapper">

    <?php include $path.'/pages/navbars/top-navbar.php'; ?>
    <?php include $path.'/pages/navbars/left-sidebar.php'; ?>

    <!-- HEADER and BREADCRUMB -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Database Access
                <!-- <small>Optional description</small> -->
            </h1>
            <ol class="breadcrumb">
                <li><a href="/TA2/DBAudit/index.php"><i class="fa fa-dashboard"></i>Home</a></li>
                <li><a href="/TA2/DBAudit/pages/database-access/database-access.php">Database Access</a></li>
                <li class="active">Database Usage</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

        <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">Database Login Chart</h3>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="userChart" style="height:230px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">Database Usage</h3>
                        </div>
                        <div class="box-body">
                            <table id="" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                    <?php if ($makerValue == 1) {?>
                                        <th>Username</th>
                                        <th>Total</th>
                                        <th>Last Access</th>
                                        <?php } else{ ?>
                                        <th>Username</th>
                                        <th>Total</th>
                                        <!-- <th>Logon Time</th>
                                        <th>spid</th> -->
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                    <tr>
                                    <?php if ($makerValue == 1) {?>
                                        <td><?php echo implode("<br> ",$name). "<br>"; ?></td>
                                      <td><?php echo implode("<br> ",$total). "<br>"; ?></td>
                                      <td><?php echo implode("<br> ",$month). "<br>"; ?></td>
                                      <?php } else{ ?>
                                      <td><?php echo implode("<br> ",$name). "<br>"; ?></td>
                                      <td><?php echo implode("<br> ",$total). "<br>"; ?></td>
                                      <!-- <td><?php //echo $row['access_time'] ?></td>
                                      <td><?php //echo $row['spid'] ?></td> -->
                                      <?php }?>
                                    </tr>
                                    
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
    <?php include $path.'/pages/navbars/control-sidebar.php'; ?>

</div>
<!-- ./wrapper -->

<?php include $path.'/pages/navbars/required-scripts.php'; ?>

<!-- SlimScroll -->
<script src="/TA2/DBAudit/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/TA2/DBAudit/bower_components/fastclick/lib/fastclick.js"></script>

<?php include $path.'/charts/db-access-charts/usage-charts.php'; ?>

<?php include $path.'/pages/navbars/end.php'; ?>
