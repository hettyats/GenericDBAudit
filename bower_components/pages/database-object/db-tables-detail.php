<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/pages/navbars/head.php'; ?>

<?php $tableID = $_GET['table'];?>
<?php include $path.'/query/database-object-query/q-db-tables-details.php'; ?>

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
                <li><a href="/TA2/DBAudit/pages/database-object/db-tables.php">Database Tables</a></li>
                <li class='active'>Database Table Details</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">Database Table Information</h3>
                        </div>
                        <div class="box-body">
                            <table class="table">
                                <tr>
                                    <th style="width:35%">Object ID</th>
                                    <td>: <?php echo $row['ObjID']; ?></td>
                                </tr>
                                <tr>
                                    <th>Object Type</th>
                                    <td>: <?php echo $row['ObjType']; ?></td>
                                </tr>
                                <tr>
                                    <th>Table Name</th>
                                    <td>: <?php echo $row['ObjName']; ?></td>
                                </tr>
                                <tr>
                                    <th>Object Schema</th>
                                    <td>: <?php echo $row['ObjSchema']; ?></td>
                                </tr>
                                <tr>
                                    <th>Create Date</th>
                                    <td>:
                                        <?php echo date('jS \of F Y - h:i:s A',strtotime($row['CrDate'])); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Last Modified Date</th>
                                    <td>:
                                        <?php echo date('jS \of F Y - h:i:s A',strtotime($row['ModDate'])); ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">Table's Columns</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Column</th>
                                        <th>Datatype</th>
                                        <th>Length</th>
                                        <th>Nullable</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $TableDef->fetch(PDO::FETCH_ASSOC)) {?>
                                    <tr>
                                        <td>
                                            <?php echo $row['Column']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Type']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Length']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Null']; ?>
                                        </td>
                                    <tr>
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

<?php include $path.'/pages/navbars/end.php'; ?>