<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/pages/navbars/head.php'; 
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }
?>

<?php include $path.'/query/database-user/q-db-password.php'; ?>
<div class="wrapper">

    <?php include $path.'/pages/navbars/top-navbar.php'; ?>
    <?php include $path.'/pages/navbars/left-sidebar.php'; ?>

    <!-- HEADER and BREADCRUMB -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Database User Password: <?php echo substr($dbnya,0,-5)?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/TA2/DBAudit/index.php"><i class="fa fa-dashboard"></i>Home</a></li>
                <li><a href="/TA2/DBAudit/pages/database-user/user-list.php">Database User</a></li>
                <li class='active'>User Last Password Change</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">User Last Password Change</h3>
                        </div>
                        <div class="box-body">
                            <table id="ViewList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                    <?php if ($makerValue == 1) {?>
                                    <th>User</th>
                                    <th>Status</th>

                                    <?php } else{ ?>
                                        <th>Username</th>
                                        <th>Hash Algorithm</th>
                                        <th>Last Change Time</th>
                                        <!-- <th>More</th> -->
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $Pass->fetch(PDO::FETCH_ASSOC)) {?>
                                    <tr>
                                    <?php if ($makerValue == 1){ ?>
                                        <?php if($row['Status'] ==  'Expired'){ ?>
                                            <tr style="background-color: #f56954;">
                                                <?php }else{ ?>
                                            <?php }?>
                                        <td><?php echo $row['us']?></td>
                                        <td><?php echo $row['Status']?></td>
                                        <?php } else{ ?>
                                            <?php if($row['lastsettime'] !== 'Not SQL Server Login' && $row['lastsettime'] > '(datediff(MM,convert(datetime,lastsettime), getdate())) > 2' ){ ?>
                                            <tr style="background-color: #f56954;">
                                                <?php }else{ ?>
                                            <?php }?>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['passhashalgo'] ?></td>
                                        <td>
                                            <?php 
                                                if($row['lastsettime'] == 'Not SQL Server Login'){ echo $row['lastsettime'] ;}
                                                else{echo date('jS \of F Y h:i:s A',strtotime($row['lastsettime']));}
                                            ?>
                                        </td>
                                        <?php }?>
                                        <!-- <td>
                                            <a href="" class="text-muted">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </td> -->
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