<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/pages/navbars/head.php'; 
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  } ?>

<?php include $path.'/query/database-access-query/q-db-unusual.php'; ?>

<div class="wrapper">

    <?php include $path.'/pages/navbars/top-navbar.php'; ?>
    <?php include $path.'/pages/navbars/left-sidebar.php'; ?>

    <!-- HEADER and BREADCRUMB -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
                Database Unusual Access <?php if ($makerValue == 1) {?>Northwind
                    <?php } else { ?>BikeStores
                <?php }?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/TA2/DBAudit/index.php"><i class="fa fa-dashboard"></i>Home</a></li>
                <li><a href="/TA2/DBAudit/pages/database-access/database-access.php">Database Access</a></li>
                <li class="active">Database Unusual Access</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">Database Unusual Access Chart</h3>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="unusChart" style="height:230px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">Database Unusual Access List</h3>
                        </div>
                        <div class="box-body">
                        <table id="AccessList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <?php if ($makerValue == 1) {?>
                                        <th>Date</th>
                                        <th>Username</th>
                                        <th>Total</th>
                                        <?php } else{ ?>
                                        <th>Date</th>
                                        <th>Username</th>
                                        <th>Total</th> 
                                        <!-- <th>More</th> -->
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php 
                                        if ($makerValue == 1) {?>
                                        <tr>
                                        <td><?php echo implode("<br> ",$month). "<br>";?></td>
                                        <td><?php echo implode("<br> ",$name). "<br>";?></td>
                                        <td><?php echo implode("<br> ",$total). "<br>";?></td>
                                      <?php } else{ ?>
                                        <td><?php echo implode("<br> ",$month). "<br>";?></td>
                                        <td><?php echo implode("<br> ",$name). "<br>";?></td>
                                        <td><?php echo implode("<br> ",$total). "<br>";?></td>
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

<?php include $path.'/charts/db-access-charts/unusual-charts.php'; ?>

<?php include $path.'/pages/navbars/end.php'; ?>