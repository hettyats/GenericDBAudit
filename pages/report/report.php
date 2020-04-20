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
                Audit Report <?php if ($makerValue == 1) {?>Northwind
                    <?php } else { ?>BikeStores
                <?php }?>
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
                    <?php if(count($outlier)>0){echo $outlier[0];} //else{echo "none";} ?>
                    <dl>
                        <dt>Database Unusual Access</dt>
                        <dd>
                            <?php if(count($outlier)>0){ ?>
                            Unusual database access found on:
                            <ul>
                                <?php
                            foreach ($outlier as &$i){ 
                                echo "<li>".$accessDate[$i].", which is ".$dbAccess[$i]." times</li>";
                             }}else{
                                 echo "There is no unusual database access.";
                             } 
                            ?>
                            </ul>
                        </dd>

                        <br>
                        <dt>Access Outside Operating Hour</dt>
                        <dl>The following user access database outside of normal operating hour:</dl>
                        <table id="AccessList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <?php if ($makerValue == 1) {?>
                                        
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
                        <?php if(count($outlier)>0){ ?>
                        <dt>Database Most Access</dt>
                        <dd>Please verify database access is correct.</dd>
                        <?php } ?>
                        <dt>Access Outside Operating Hour</dt>
                        <dd>Make sure the access is indeed carried out by authorized users and check the activities carried out by these users.<dd>
                    </dl>
                    <h3>Observation Database User</h3>
                    <dl>
                        <dt>Inactive User</dt>
                        <!-- <dl>This user is not using the database for several times:</dl> -->
                        <dd>There is no Inactive User in database.
                        </dd>
                        <br/>
                        <dt>Not Change Password </dt>
                        <dl>This user is not change the password for several times:</dl>
                        <dd>
                        </dd>
                    </dl>
                    <h4>Recommendation</h4>
                    <dl>
                        <!-- <dt>Inactive User</dt>
                        <dd></dd> -->
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