<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/pages/navbars/head.php'; ?>

<?php $permissionType = $_GET['perm']; ?>

<?php include $path.'/query/database-user/q-db-privilege-detail.php'; ?>
<div class="wrapper">

    <?php include $path.'/pages/navbars/top-navbar.php'; ?>
    <?php include $path.'/pages/navbars/left-sidebar.php'; ?>

    <!-- HEADER and BREADCRUMB -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Database User
            </h1>
            <ol class="breadcrumb">
                <li><a href="/TA2/DBAudit/index.php"><i class="fa fa-dashboard"></i>Home</a></li>
                <li><a href="/TA2/DBAudit/pages/database-user/user-list.php">Database User</a></li>
                <li><a href="/TA2/DBAudit/pages/database-user/privilege.php">Database Privileges</a></li>
                <li class='active'>Database Privileges</a></li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">Database Privileges: <?php echo $permissionType ?></h3>
                        </div>
                        <div class="box-body">
                            <table id="ViewList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Permission State</th>
                                        <th>Login Name</th>
                                        <th>Login Type</th>
                                        <th>Database User Name</th>                                        
                                        <th>Object Type</th>
                                        <th>Object Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $Privilege->fetch(PDO::FETCH_ASSOC)) {?>
                                    <tr>
                                        <td><?php echo $row['State'] ?></td>
                                        <td><?php echo $row['Login'] ?></td>
                                        <td><?php echo $row['Type'] ?></td>
                                        <td><?php echo $row['User'] ?></td>
                                        <td><?php echo $row['ObjType'] ?></td>
                                        <td><?php echo $row['Obj'] ?></td>
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
<?php include $path.'/pages/navbars/end.php'; ?>