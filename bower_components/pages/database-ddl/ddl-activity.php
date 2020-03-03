<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/pages/navbars/head.php'; ?>

<?php include $path.'/query/ddl-query/q-db-activities.php'; ?>

<div class="wrapper">

    <?php include $path.'/pages/navbars/top-navbar.php'; ?>
    <?php include $path.'/pages/navbars/left-sidebar.php'; ?>

    <!-- HEADER and BREADCRUMB -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                DDL Activity
                <!-- <small>Optional description</small> -->
            </h1>
            <ol class="breadcrumb">
                <li><a href="/TA2/DBAudit/index.php"><i class="fa fa-dashboard"></i>Home</a></li>
                <li><a href="/TA2/DBAudit/pages/database-ddl/ddl-activity.php">DDL Activity</a></li>
                <li class="active">DDL Activities</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">DDL Activities</h3>
                        </div>
                        <div class="box-body">
                            <canvas id="ddlActivityChart" style="height:250px"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">DDL Activities List</h3>
                        </div>
                        <div class="box-body">
                            <table id="ddlActList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Activity Type</th>
                                        <th>Login Name</th>
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $ActivityList->fetch(PDO::FETCH_ASSOC)) {?>
                                    <tr>
                                        <td>
                                            <?php echo date('jS \of F Y h:i:s A',strtotime($row['Date']))?>
                                        </td>
                                        <td>
                                            <?php echo $row['Type']?>
                                        </td>
                                        <td>
                                            <?php echo $row['Name']?>
                                        </td>
                                        <td>
                                            <a href="" class="text-muted">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </td>
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
    $('#ddlActList').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': true
    })
})
</script>

<?php include $path.'/charts/ddl-charts/activities-charts.php'; ?>

<?php include $path.'/pages/navbars/end.php'; ?>