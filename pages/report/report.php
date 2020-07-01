<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/pages/navbars/head.php'; 
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  } 

?>

<?php include $path.'/query/report-query/q-report.php'; ?>

<div class="wrapper">

    <?php include $path.'/pages/navbars/top-navbar.php'; ?>
    <?php include $path.'/pages/navbars/left-sidebar.php'; ?>

    <!-- HEADER and BREADCRUMB -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Audit Report 
            </h1>
            <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i><a href="/TA2/DBAudit/index.php">Home</a></li>
                <li class="active">Audit Report</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="invoice">

            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-pie-chart"></i> Database Audit Report: <?php if ($makerValue == 1) {?>Northwind
                    <?php } else { ?>BikeStores
                <?php }?>
                        <small class="pull-right">Date: <?php echo date('F, j Y'); ?></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <h3>Observation Database Access</h3>
                    <dl>
                        <dt>Database Unusual Access</dt>
                        <dd>
                            Unusual database access found on:
                        </dd>
                        <div class="box-body">
                            <table id="AccessList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <?php if ($makerValue == 1) {?>
                                        <th>Date</th>
                                        <th>Username</th>
                                        <th>Total</th>
                                        <?php } else{ ?>
                                        <th>Date</th>
                                        <th>Username</th>
                                        <th>Total</th> 
                                        <!-- <th>More</th> -->
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                        if ($makerValue == 1) {?>
                                        <tr>
                                        <td><?php echo ($row['event_time'])?> </td>
                                        <td><?php echo ($row['user_host'])?></td>
                                        <td><?php echo ($row['Total'])?></td>
                                      <?php } else{ ?>
                                        <td><?php echo ($row['Day'] . " " . date('F', mktime(0, 0, 0, $row['Month'], 10)) . " " . $row['Year']) ?></td>
                                        <td><?php echo ($row['login_name'])?></td>
                                        <td><?php echo ($row['Total'])?></td>
                                      <?php }?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            
                            <h4>Recommendation</h4>
                        
                        <dt>Database Most Access</dt>
                        <dd>Please verify database access is correct.</dd>
                        </dd>
                        </div>

                        <br>
                        
                        <dt>Access Outside Operating Hour</dt>
                        <dl>The following user access database outside of normal operating hour:</dl>
                        <table id="AccessList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <?php if ($makerValue == 1) {?>
                                        <th>Username</th>
                                          <th>Total Access</th>
                                          <th>Last Access On</th>
                                        <?php } else{ ?>
                                          <th>Username</th>
                                          <th>Total Access</th>
                                          <th>Last Access On</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php while ($row = $dbOutside->fetch(PDO::FETCH_ASSOC)) {
                                        if ($makerValue == 1) {?>
                                        <td> <?php echo $row['user_host']?> </td>
                                      <td> <?php echo $row['Total']?></td>
                                      <td><?php echo $row['event_time']?></td>
                                      <?php } else{ ?>
                                      <td> <?php echo $row['login_name']?> </td>
                                      <td> <?php echo $row['Total']?></td>
                                      <td><?php echo date('jS \of F Y h:i:s A',strtotime($row['last_access'])); ?></td>
                                      <?php }?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                    </dl>
                    <h4>Recommendation</h4>
                    <dl>
                        <dt>Access Outside Operating Hour</dt>
                        <dd>Make sure the access is indeed carried out by authorized users and check the activities carried out by these users.<dd>
                    </dl>
                    <h3>Observation Database User</h3>
                    <dl>
                        <dt>Inactive User</dt>
                        <dl>This user is not using the database for several times:</dl>
                        <div class="box-body">
                            <table id="ViewList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                    <?php if ($makerValue == 1) {?>
                                        <th>Username</th>
                                        <th>Last Access Time</th>
                                        <?php } else{ ?>
                                        <th>Username</th>
                                        <th>Program Name</th>
                                        <th>Last Access Time</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while ($row = $NA->fetch(PDO::FETCH_ASSOC)) {
                                    if ($makerValue == 1) {?>
                                    <td><?php echo $row['user_host'] ?></td>
                                    <td><?php echo $row['last_acccess'] ?></td>
                                       <?php } else{ ?>
                                <tr>
                                    <td><?php echo $row['login_name'] ?></td>
                                    <td><?php echo $row['program_name'] ?></td>
                                    <td><?php echo $row['last_access'] ?></td>
                                    <?php }?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- <dd>There is no Inactive User in database.
                        </dd> -->

                        <h4>Recommendation</h4>
                    <dl>
                        <dt>Inactive User</dt>
                        <dd>Make sure the user </dd>
                    </dl>

                        <br>
                        <dt>Not Change Password </dt>
                        <dl>This user is not change the password for several times:</dl>
                        <div>
                        <table id="NotChangePWList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <?php if ($makerValue == 1) {?>
                                        
                                        <?php } else{ ?>
                                        <th>Username</th>
                                        <th>Hash Algorithm</th>
                                        <th>Last Change Time</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php while ($row = $dbChangePW->fetch(PDO::FETCH_ASSOC)) {
                                        if ($makerValue == 1) {?>
                                       
                                      <?php } else{ ?>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['passhashalgo'] ?></td>
                                        <td>
                                            <?php 
                                                if($row['lastsettime'] == 'Not SQL Server Login'){ echo $row['lastsettime'] ;}
                                                else{echo date('jS \of F Y h:i:s A',strtotime($row['lastsettime']));}
                                            ?>
                                        </td>
                                      <?php }?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <dd>
                        </dd>
                    </dl>
                    <h4>Recommendation</h4>
                    <dl>
                        <dt>Not Change Password </dt>
                        <dd>Make sure</dd>
                    </dl>

                </div>
            </div>

            <!-- <div class="row no-print">
                <div class="col-xs-12">
                    <a href="pdf.php" target="_blank" class="btn btn-primary pull-right" style="margin-right: 5px;">
                        <i class="fa fa-download"></i> Print Report
                    </a>
                </div>
            </div> -->

        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
    <!-- /.content-wrapper -->

    <?php include $path.'/pages/navbars/footer.php'; ?>
    <?php include $path.'/pages/navbars/control-sidebar.php'; ?>

</div>
<!-- ./wrapper -->

<?php include $path.'/pages/navbars/required-scripts.php'; ?>

<!-- CHARTS -->
<?php //include $path.'/charts/index-charts/index-charts.php'; ?>

<?php include $path.'/pages/navbars/end.php'; ?>