<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/query/report-query/q-report.php'; 
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  } 
?>

<!DOCTYPE html>
<html>
<style>
    h3{
    margin-top: 0;
    margin-bottom: 10px;
        }
        
        .page-header {
    margin: 10px 0 5px 0;}

    @media print {
  body, .wrapper {
    display: block !important;
    position: relative !important;
    width: auto !important;
    height: auto !important;
    overflow: visible !important;
    margin-left: 0 !important;
  }
}
        </style>
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
                        <i class="fa fa-pie-chart"></i> Database Audit Report: <?php echo substr($dbnya,0,-5)?>
                        <small class="pull-right">Date: <?php echo date('F, j Y'); ?></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-xs-12">

                    <h3><dt>Observation Database Access</dt></h3>
                    <?php //if(count($outlier)>0){echo $outlier[0];}else{echo "none";} ?>
                    <dl>
                        <h4><b>Database Unusual Access</b></h4>
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
                    </dl> <?php if(count($outlier)>0){ ?>
                    <h4>Recommendation</h4>
                    <dl>
                        <dt>Database Most Access</dt>
                        <dd>Please verify database access is correct.</dd>
                        <?php } ?>
                    </dl>
                    <h4><b>Access Outside Operating Hour</b></h4>
                        <dd>The following user access database outside of normal operating hour:</dd>
                        <table id="AccessList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Total Access</th>
                                        <th>Last Access On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php 
                                        while ($row = $dbOutside->fetch(PDO::FETCH_ASSOC)) {
                                                if ($makerValue == 1 && $row != 0) {?>
                                                <tr>
                                                  <td> <?php echo $row['user_host']?> </td>
                                                  <td> <?php echo $row['Total']?></td>
                                                  <td><?php echo date('jS \of F Y h:i:s A',strtotime($row['event_time']));?></td>
                                                </tr>
                                               
                                                  <?php } else if($makerValue == 2 && $row != 0){ 
                                                      ?>
                                                    <tr>  
                                                  <td> <?php echo $row['login_name']?> </td>
                                                  <td> <?php echo $row['Total']?></td>
                                                  <td><?php echo date('jS \of F Y h:i:s A',strtotime($row['last_access'])); ?></td>
                                                  </tr>
                                                  <?php } else{?>
                                                <tr>
                                                    <td>No result found</td>
                                                    <td>No result found</td>
                                                    <td>No result found</td>
                                                </tr> <?php } ?>
                                                  <?php 
                                                  if(!$row){ echo "There is no Outside Operating hour Access";?>
                                                    <br/>
                                        <?php } }?>      
                                </tbody>
                            </table>
                    </dl><h4><b>Recommendation</b></h4><dl>
                        <dt>Access Outside Operating Hour</dt>
                        <dd>Make sure the access is indeed carried out by authorized 
                            users and check the activities carried out by these users.<dd>
                    </dl>

                    <hr>
                    <h3><dt>Observation Database User<dt></h3>
                    <dl>
                        <h4><b>Inactive User</b></h4>
                        <dd>This user is not using the database for several times:</dd>
                        <div class="box-body">
                            <table id="ViewList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Last Access Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while ($row = $NA->fetch(PDO::FETCH_ASSOC)) {
                                    if ($makerValue == 1 && $row != 0) {?>
                                    <tr>
                                    <td><?php echo $row['user_host'] ?></td>
                                    <td><?php echo date('jS \of F Y h:i:s A',strtotime($row['last_access'])); ?></td>
                                        </tr>
                                       <?php } else if ($makerValue == 2 && $row != 0){ ?>
                                        <tr>
                                    <td><?php echo $row['login_name'] ?></td>
                                    <td><?php echo date('jS \of F Y h:i:s A',strtotime($row['last_access'])); ?></td>
                                    </tr>
                                    <?php } else if(!$row){?>
                                        <tr>
                                        <td>No result found</td>
                                        <td>No result found</td>
                                    </tr>
                                   
                                    <?php }
                                                  if(!$row){ echo "There is no Inactive User in database."; }  ?> 
                                    <?php  }?> 
                                    </tbody>
                                    </table>
                        </div>
                        <h4><b>Recommendation</b></h4>
                    <dl>
                        <dt>Inactive User</dt>
                        <dd>Please check the user who did not access the database within the time limit, 
                            deactivate the user whose name is listed above.</dd>
                        <br/>


                        <h4><b>Not Change Password </b></h4>
                        <dl>This user is not change the password for several times:</dl>
                        <div>
                        <table id="NotChangePWList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <?php if ($makerValue == 1 ) {?>
                                        <th>Username</th>
                                        <th>Status</th>
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
                                        if ($makerValue == 1 && $row != 0) {?>
                                        <td><?php echo $row['user'].'@'.$row['host'] ?></td>
                                        <td><?php echo $row['Status'] ?></td>
                                      <?php } else if($makerValue == 2 && $row != 0){ ?>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['passhashalgo'] ?></td>
                                        <td>
                                            <?php 
                                                if($row['lastsettime'] == 'Not SQL Server Login'){ echo $row['lastsettime'] ;}
                                                else{echo date('jS \of F Y h:i:s A',strtotime($row['lastsettime']));}
                                            ?>
                                        </td>
                                        <?php } else if($makerValue == 1 && !$row){?>
                                        <tr>
                                        <td>No result found</td>
                                        <td>No result found</td>
                                         </tr>
                                      <?php } else if($makerValue == 2 && !$row){?>
                                        <tr>
                                        <td>No result found</td>
                                        <td>No result found</td>
                                        <td>No result found</td>
                                         </tr>
                                        <?php }  ?> 
                                       
                                    </tr>
                                    <?php } if($row){ echo "There is no user that not change Password."; }  ?>   
                                    </tbody>
                            </table>                            
                        </div>
                        <dd>
                        </dd>
                    </dl>
                    <h4><b>Recommendation</b></h4>
                    <dl>
                        <dt>Not Change Password </dt>
                        <dd>Please change the user password mention in this observation, or temporarily disable the user.</dd>
                    </dl>
                </div>
            </div>

                </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
</body>


</html>