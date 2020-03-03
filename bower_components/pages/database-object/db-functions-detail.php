<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/pages/navbars/head.php'; ?>

<?php $functionID = $_GET['function'];?>
<?php include $path.'/query/database-object-query/q-db-function-details.php'; ?>

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
                <li><a href="/TA2/DBAudit/pages/database-object/db-views.php">Database Functions</a></li>
                <li class='active'>Database Function Details</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">Database Function Information</h3>
                        </div>
                        <div class="box-body">

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:35%">Object ID</th>
                                        <td>: <?php echo $rowFunction['ID']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Object Type</th>
                                        <td>: <?php echo $rowFunction['Type']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Function Name</th>
                                        <td>: <?php echo $rowFunction['Name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Function Schema</th>
                                        <td>: <?php echo $rowFunction['Schema']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Create Date</th>
                                        <td>:
                                            <?php echo date('jS \of F Y - h:i:s A',strtotime($rowFunction['CrDate'])); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Last Modified Date</th>
                                        <td>:
                                            <?php echo date('jS \of F Y - h:i:s A',strtotime($rowFunction['ModDate'])); ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="box-header">
                            <h3 class="box-title">Function Definition</h3>
                        </div>
                        <div class="box-body">
                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;font-weight: 600;">
                                <?php echo $rowFunction['Def']; ?>
                            </p>
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


<?php include $path.'/pages/navbars/end.php'; ?>