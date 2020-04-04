<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/pages/navbars/head.php'; ?>

<?php include $path.'/query/database-user/q-db-user.php'; ?>

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
                <li class='active'>Database User List</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">Database User List</h3>
                        </div>
                        <div class="box-body">
                            <table id="ViewList" class="table table-bordered table-hover">
                                <thead>
                                  <tr>
                                    <th>Username</th>
                                    <th>Principal_id</th>
                                    <th>Create Date</th>
                                    <th>Modify Date</th>
                                    <th>Type Description</th>
                                    <th>Authentication Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <?php while ($row = $LoginName->fetch(PDO::FETCH_ASSOC)) {?> -->
                                <tr>
                                  <td><?php echo $row['name'] ?></td>
                                  <td><?php echo $row['principal_id'] ?></td>
                                  <td><?php echo $row['create_date'] ?></td>
                                  <td><?php echo $row['type_desc'] ?></td>
                                  <td><?php echo $row['modify_date'] ?></td>
                                  <td><?php echo $row['authentication_type'] ?></td>
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
