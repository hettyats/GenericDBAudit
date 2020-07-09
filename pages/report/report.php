<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/pages/navbars/head.php'; 
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  } 

?>

<?php include $path.'/query/report-query/q-report.php'; ?>
<style>
        .h3, h3{
    margin-top: 10px;
    margin-bottom: 10px;
        }
        .page-header {
    margin: 10px 0 5px 0;}
    </style>

<div class="wrapper">

    <?php include $path.'/pages/navbars/top-navbar.php'; ?>
    <?php include $path.'/pages/navbars/left-sidebar.php'; ?>

    <!-- HEADER and BREADCRUMB -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            <i class="fa fa-pie-chart"></i>Database Audit Report           <a href="pdf.php?id=<?php echo $makerValue?>" target="_blank" class="btn btn-primary" style="margin-right: 5px;">
                        <i class="fa fa-print"></i> Print Report
                    </a>
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
                    <h3>
                        <i class="fa fa-database"></i> Database Name: <?php if ($makerValue == 1) {?>Northwind
                    <?php } else { ?>BikeStores
                <?php }?>
                        <small class="pull-right">Date: <?php echo date('F, j Y'); ?></small>
                    </h3>
                </div>
                <!-- /.col -->
            </div>
                    </section><section class="invoice">
            <div class="row">
                <div class="col-xs-12">
                    <h3><dt>Observation Database Access</dt></h3>
                    <dl> 
                        <h4><b>Database Unusual Access</b></h4>
                        <?php if(count($outlier)>0){?>
                        <dd> 
                            Unusual database access found on:
                        </dd>
                        <div class="box-body">
                            <table id="AccessList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Username</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php while ($row = $dbAccessStmt->fetch(PDO::FETCH_ASSOC)) {
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
                        <h4><b>Recommendation<b></h4>
                        <dt>Database Most Access</dt>
                        <dd>Please verify database access is correct.</dd>
                        </dd> 
                        </div>
                        <?php } else{ echo "There is no unusual database access.";?>
                         <br/>
                        <?php } ?>
                        <br/>

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
                                                  <td><?php echo date('jS \of F Y h:i:s A',strtotime($row['last_access']));?></td>
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
                    </section>
                    
                    <section class="invoice">
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

        </section>
        <!-- /.content -->
        <!-- <div class="clearfix"></div> -->
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