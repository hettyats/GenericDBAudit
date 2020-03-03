<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/query/report-query/q-report.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Database Audit Tool</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/TA2/DBAudit/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/TA2/DBAudit/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/TA2/DBAudit/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/TA2/DBAudit/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="/TA2/DBAudit/dist/css/skins/skin-blue.min.css">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body onload="window.print();">

    <!-- <body> -->
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">

            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-pie-chart"></i> Database Audit Report: Northwind
                        <small class="pull-right">Date: <?php echo date('F, j Y'); ?></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-xs-12">

                    <h3>Observation No. 1: Database Access</h3>
                    <?php //if(count($outlier)>0){echo $outlier[0];}else{echo "none";} ?>
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

                        <!-- <br>
                        <dt>Database Failed Access</dt>
                        <dl>Database failed access on:</dl> -->
                    </dl>
                    <h4>Recommendation</h4>
                    <dl>
                        <?php if(count($outlier)>0){ ?>
                        <dt>Database Most Access</dt>
                        <dd>Please verify database access is correct.</dd>
                        <?php } ?>
                    </dl>

                    <hr>
                    <h3>Observation No. 2: Database Object</h3>
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

                    <hr>
                    <h3>Observation No. 3: Database Data-Definition Languange (DDL) Activity</h3>
                    <dl>
                        <dt>test</dt>
                        <dd>
                            test
                        </dd>
                    </dl>
                    <h4>Recommendation</h4>
                    <dl>
                        <dt>test</dt>
                        <dd>test</dd>
                    </dl>

                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
</body>
</body>

</html>