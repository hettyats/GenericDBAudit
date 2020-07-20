<?php session_start();
 $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit';
if(!isset($_SESSION["user"])) header("Location: $path.'/login.php'");
?>
<?php include $path.'/pages/navbars/head.php'; ?>

<?php include $path.'/query/database-user/q-db-not-active.php'; 
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Database Audit Tool</title>
</head>
<div class="wrapper">

    <?php include $path.'/pages/navbars/top-navbar.php'; ?>
    <?php include $path.'/pages/navbars/left-sidebar.php'; ?>

    <!-- HEADER and BREADCRUMB -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Database Not Active User: <?php echo substr($dbnya,0,-5)?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/TA2/DBAudit/index.php"><i class="fa fa-dashboard"></i>Home</a></li>
                <li><a href="/TA2/DBAudit/pages/database-user/user-list.php">Database User</a></li>
                <li class='active'>Not Active User List</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">Not Active User List</h3>
                        </div>
                        <div class="box-body">
                            <table id="ViewList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Last Access</th>
                                        <!-- <th>More</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while ($row = $NA->fetch(PDO::FETCH_ASSOC)) {?>
                                <tr> <?php if ($makerValue == 1){ ?>
                                    <td><?php echo $row['user_host'] ?></td>
                                    <td><?php echo $row['last_access'] ?></td>
                                    <?php } else{ ?>
                                    <td><?php echo $row['login_name'] ?></td>
                                    <td><?php echo $row['last_access'] ?></td> <?php }?>
                                </tr>
                                </tbody>
                                <?php }?>
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