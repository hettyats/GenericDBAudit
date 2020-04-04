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
                        <i class="fa fa-pie-chart"></i> Database Audit Report: <?php $dbname ?>
                        <small class="pull-right">Date: <?php echo date('F, j Y'); ?></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-xs-12">

                    <h3>Observation Database Access</h3>
                    <?php if(count($outlier)>0){echo $outlier[0];}else{echo "none";} ?>
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
                        <dt>Database Failed Access</dt>
                        <dl>Database failed access on:</dl>
                    </dl>
                    <h4>Recommendation</h4>
                    <dl>
                        <?php if(count($outlier)>0){ ?>
                        <dt>Database Most Access</dt>
                        <dd>Please verify database access is correct.</dd>
                        <?php } ?>
                    </dl>

                    <!-- <h3>Observation No. 2: Database Object</h3>
                    <dl>
                        <dt>Database Dependencies</dt>
                        <dd>
                            <?php if(count($dependID) > 0){ ?>
                            This database object did not have depend object:
                            <table class="table table-striped">
                                <thead>
                                    <th>Object ID</th>
                                    <th>Object Name</th>
                                    <th>Object Type</th>
                                </thead>
                                <tbody>
                                    <?php for($i=0;$i<count($dependID);$i++){ ?>
                                    <tr>
                                        <td><?php echo $dependID[$i]?></td>
                                        <td><?php echo $dependName[$i] ?></td>
                                        <td><?php echo "View" ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php }else{ ?>
                            All database object are fine.
                            <?php } ?>
                        </dd>
                    </dl>
                    <h4>Recommendation</h4>
                    <dl>
                        <?php if(count($dependID) > 0){ ?>
                        <dt>Database Dependencies</dt>
                        <dd>
                            Delete the database object or fix the database depend object:
                            <ul>
                                <?php for($i=0;$i<count($dependID);$i++){ ?>
                                <li><?php echo $dependName[$i]." (Object ID: ".$dependID[$i].")"; ?></li>
                                <?php } ?>
                            </ul>
                        </dd>
                        <?php } ?>
                    </dl>
                     -->
                    <!-- <h3>Observation No. 3: Database Data-Definition Languange (DDL) Activity</h3>
                    <dl>
                        <dt>Most DDL Activity</dt>
                        <dd>
                            
                        </dd>
                    </dl>
                    <h4>Recommendation</h4>
                    <dl>
                        <dt>Most DDL Activity</dt>
                        <dd></dd>
                    </dl>

                    <h3>Observation No. 4: Database Error</h3>
                    <dl>
                        <dt>Failed Login</dt>
                        <dd>
                        </dd>
                        <dt>Syntax Error</dt>
                        <dd>
                        </dd>
                    </dl>
                    <h4>Recommendation</h4>
                    <dl>
                        <dt>Failed Login</dt>
                        <dd></dd>
                        <dt>Syntax Error</dt>
                        <dd></dd>
                    </dl> -->

                    <h3>Observation Database User</h3>
                    <dl>
                        <dt>Inactive User</dt>
                        <dd>
                        </dd>
                    </dl>
                    <!-- <h4>Recommendation</h4>
                    <dl>
                        <dt>Inactive User</dt>
                        <dd></dd>
                    </dl> -->

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