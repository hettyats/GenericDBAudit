<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/pages/navbars/head.php'; 
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }
    if (isset($_GET['usedb'])) {
    $dbnya = $_GET['usedb'];
    // echo "masuk pak eko ".$dbnya;
  }

  if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
    $_SESSION['id']=$makerValue;
    // echo "masuk pak eko ".$makerValue;
} 
?>

<?php //$user_host = $_GET['user_host'];
// $total = $_GET['Total'];?>

<?php include $path.'/query/database-access-query/q-db-failed-detail.php'; ?>
<div class="wrapper">

    <?php include $path.'/pages/navbars/top-navbar.php'; ?>
    <?php include $path.'/pages/navbars/left-sidebar.php'; ?>

    <!-- HEADER and BREADCRUMB -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Database Failed Login Detail: <?php echo substr($dbnya,0,-5)?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/TA2/DBAudit/index.php"><i class="fa fa-dashboard"></i>Home</a></li>
                <li><a href="/TA2/DBAudit/pages/database-access/failed-login.php?id=<?php echo $makerValue ?>&usedb=<?php echo $dbnya?>">Database Access</a></li>
                <li><a href="/TA2/DBAudit/pages/database-access/failed-login.php?id=<?php echo $makerValue ?>&usedb=<?php echo $dbnya?>">Failed Login</a></li>
                <li class='active'>Failed Login Detail</a></li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">Failed Login : </h3>
                        </div>
                        <div class="box-body">
                            <table id="FailDetList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                    <?php if ($makerValue == 1) {?>
                                        <th>Host</th>
                                        <th>Last Access Time</th>
                                        <th>Arguments</th>
                                    
                                    <?php } else{ ?>
                                      <th>Message</th>
                                      <th>Date</th>
                                      <th>Source</th>
                                      <?php }?> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $ListErr->fetch(PDO::FETCH_ASSOC)) {?>
                                    <tr>
                                    <?php if ($makerValue == 1) {?>
                                    <td><?php echo $row['user_host']?></td>
                                    <td><?php echo $row['event_time']?></td>
                                    <td><?php echo $row['argument']?></td>

                                    <?php } else{ ?>
                                        <td><?php echo $row['error_message'] ?></td>
                                        <td><?php echo $row['error_date'] ?></td>
                                        <td><?php echo $row['source'] ?></td>
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
<?php include $path.'/pages/navbars/end.php'; ?>