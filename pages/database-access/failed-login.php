<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/pages/navbars/head.php'; 
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  } ?>

<?php include $path.'/query/database-access-query/q-db-loginerror.php'; ?>
<div class="wrapper">

    <?php include $path.'/pages/navbars/top-navbar.php'; ?>
    <?php include $path.'/pages/navbars/left-sidebar.php'; ?>

    <!-- HEADER and BREADCRUMB -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Database Error <?php if ($makerValue == 1) {?>Northwind
                    <?php } else { ?>BikeStores
                <?php }?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/TA2/DBAudit/index.php"><i class="fa fa-dashboard"></i>Home</a></li>
                <li><a href="/TA2/DBAudit/pages/database-access/failed-login.php">Database Access</a></li>
                <li class='active'>Failed Login</a></li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">Login Failed List</h3>
                        </div>
                        <div class="box-body">
                            <table id="ViewList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <?php if ($makerValue == 1) {?>
                                        <th>Error Message</th>
                                        <th>Total of Error</th>
                                        <th>Last Error Date</th>
                                        <th>More</th>
                                        <?php } else{ ?>
                                        <th>Error Message</th>
                                        <th>Total of Error</th>
                                        <th>Last Error Date</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php while ($row = $Error->fetch(PDO::FETCH_ASSOC)) {
                                        if ($makerValue == 1) {?>
                                        <td><?php echo $row['user_host'] ?></td>
                                        <td><?php echo $row['Total'] ?></td>
                                        <td><?php echo $row['event_time'] ?></td>
                                        <?php } else{ ?>
                                        <td><?php echo $row['Message'] ?></td>
                                        <td><?php echo $row['Total'] ?></td>
                                        <td><?php echo $row['Date'] ?></td>
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
    <?php include $path.'/pages/navbars/control-sidebar.php'; ?>

</div>
<!-- ./wrapper -->

<?php include $path.'/pages/navbars/required-scripts.php'; ?>

<!-- SlimScroll -->
<script src="/TA2/DBAudit/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/TA2/DBAudit/bower_components/fastclick/lib/fastclick.js"></script>

<!-- DATA TABLES -->
<script src="/TA2/DBAudit/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/TA2/DBAudit/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
$(function() {
    $('#Error').DataTable({
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