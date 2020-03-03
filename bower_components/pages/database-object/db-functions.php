<?php $path = $_SERVER['DOCUMENT_ROOT'] . '/TA2/DBAudit';?>
<?php include $path . '/pages/navbars/head.php';?>

<?php include $path . '/query/database-object-query/q-db-functions.php';?>

<div class="wrapper">

    <?php include $path . '/pages/navbars/top-navbar.php';?>
    <?php include $path . '/pages/navbars/left-sidebar.php';?>

    <!-- HEADER and BREADCRUMB -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Database Object
                <!-- <small>Optional description</small> -->
            </h1>
            <ol class="breadcrumb">
                <li><a href="/TA2/DBAudit/index.php"><i class="fa fa-dashboard"></i>Home</a></li>
                <li><a href="/TA2/DBAudit/pages/database-object/db-tables.php">Database Objects</a></li>
                <li class="active">Database Functions</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">Database Function List</h3>
                        </div>
                        <div class="box-body">
                            <table id="functionList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Object ID</th>
                                        <th>Function Name</th>
                                        <th>Create Date</th>
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $FunctionList->fetch(PDO::FETCH_ASSOC)) {?>
                                    <tr>
                                        <td><?php echo $row['ObjID'] ?></td>
                                        <td><?php echo $row['ObjName'] ?></td>
                                        <td><?php echo date('jS \of F Y h:i:s A',strtotime($row['CrDate']))?>
                                        <td>
                                            <a href="/TA2/DBAudit/pages/database-object/db-functions-detail.php?function=<?php echo $row['ObjID'] ?>" class="text-muted">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php }?>
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

    <?php include $path . '/pages/navbars/footer.php';?>
    <?php include $path . '/pages/navbars/control-sidebar.php';?>

</div>
<!-- ./wrapper -->

<?php include $path . '/pages/navbars/required-scripts.php';?>

<!-- SlimScroll -->
<script src="/TA2/DBAudit/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/TA2/DBAudit/bower_components/fastclick/lib/fastclick.js"></script>

<!-- DATA TABLES -->
<script src="/TA2/DBAudit/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/TA2/DBAudit/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
$(function() {
    $('#functionList').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true
    })
})
</script>

<?php include $path . '/pages/navbars/end.php';?>