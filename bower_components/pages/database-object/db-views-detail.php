<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/pages/navbars/head.php'; ?>

<?php $viewID = $_GET['view'];?>
<?php include $path.'/query/database-object-query/q-db-view-details.php'; ?>

<div class="wrapper">

    <?php include $path.'/pages/navbars/top-navbar.php'; ?>
    <?php include $path.'/pages/navbars/left-sidebar.php'; ?>

    <!-- HEADER and BREADCRUMB -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Database Object
                <!-- <small>Database Table Details</small> -->
            </h1>
            <ol class="breadcrumb">
                <li><a href="/TA2/DBAudit/index.php"><i class="fa fa-dashboard"></i>Home</a></li>
                <li><a href="/TA2/DBAudit/pages/database-object/db-tables.php">Database Objects</a></li>
                <li><a href="/TA2/DBAudit/pages/database-object/db-views.php">Database Views</a></li>
                <li class='active'>Database View Details</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">Database View Information</h3>
                        </div>
                        <div class="box-body">

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:35%">Object ID</th>
                                        <td>: <?php echo $rowView['ObjID']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Object Type</th>
                                        <td>: <?php echo $rowView['ObjType']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>View Name</th>
                                        <td>: <?php echo $rowView['ObjName']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Object Schema</th>
                                        <td>: <?php echo $rowView['ObjSchema']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Create Date</th>
                                        <td>:
                                            <?php echo date('jS \of F Y - h:i:s A',strtotime($rowView['CrDate'])); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Last Modified Date</th>
                                        <td>:
                                            <?php echo date('jS \of F Y - h:i:s A',strtotime($rowView['ModDate'])); ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="box-header">
                            <h3 class="box-title">View Definition</h3>
                        </div>
                        <div class="box-body">
                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;font-weight: 600;">
                                <?php echo $rowView['ObjDef']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title"> View Dependency</h3>
                        </div>
                        <div class="box-body">
                            <table id="ViewDependency" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Object ID</th>
                                        <th>Object Name</th>
                                        <th>Object Type</th>
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($rowNum['Num'] <= 0){ ?>
                                    <div class="callout callout-danger">
                                        <h4>No Database Object Found!</h4>

                                        <p>The object's name may have been changed or deleted.</p>
                                    </div>
                                    <?php }else{?>
                                    <?php while ($rowDepend=$ViewDependency->fetch(PDO::FETCH_ASSOC)) {?>
                                    <tr>
                                        <td><?php echo $rowDepend['DepID']; ?></td>
                                        <td><?php echo $rowDepend['Dep']; ?></td>
                                        <td><?php echo $rowDepend['Type']; ?></td>
                                        <td>
                                            <a href="" class="text-muted">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section> <!-- /.content -->
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
    $('#ViewDependency').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': false
    })
})
</script>


<?php include $path.'/pages/navbars/end.php'; ?>