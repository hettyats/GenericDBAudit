<?php session_start();
if(!isset($_SESSION["user"])) header("Location: login.php");
$path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php 
// include $path.'/pages/navbars/head.php'; 
include $path.'/connection/connection.php';
// include $path.'/q-period.php';

if(isset($_SESSION["id"])){
  $makerValue = $_SESSION["id"];
  // echo $makerValue;
}
if (isset($_GET['usedb'])) {
  $dbnya = $_GET['usedb'];
  // echo $dbnya;
}
if (isset($_GET['db'])) {
  $db = $_GET['db'];
}
if(isset($_SESSION["user"])){
  $user = $_SESSION["user"];
  // echo $user["username"];
}

?>


<!DOCTYPE html>
<html>
<style type="text/css">
  body {
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
  }

a {
  text-decoration: none;
  display: inline-block;
  padding: 7px 16px;
}

.previous {
  background-color: #f1f1f1;
  color: black;
}
</style>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Database Audit Tool | Audit period</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php $path ?>./bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php $path ?>./bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php $path ?>./bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php $path ?>./dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php $path ?>./plugins/iCheck/square/blue.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php $path ?>./bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  
</head>

<body class="hold-transition login-page" style=" background-size: cover;">
  <div class="login-box" style="margin-left: auto; margin-right: auto; margin-top:20px; width:500px;" >
    <div class="login-box-body" style="background-color:White; width: 100%; bottom: 0; right: 0;">
      <div class="login-logo" style="margin-bottom: 10px;">
      <a href="./index.php"><b>Database Audit Tool</b></a><hr>
        <h3>Audit Period</h3>
      </div>
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Exists period</a></li>
        <li><a data-toggle="tab" href="#menu1">Create New audit period</a></li>
      </ul>
      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
        <form method="post" action="">
          <div class="form-group has-feedback">
          <br/>
          <h4 class="login-box-msg">Audit information ever conducted on database <?php echo substr($dbnya,0,-5)?></h4>
          <h5 class="login-box-msg">Database Audit name: <b><?php echo $dbnya?></b></h5>
              <table id="period" class="table table-bordered table-hover">
                  <thead>
                      <tr>
                          <th>Period Name</th>
                          <th>Period Start</th>
                          <th>Period End</th>
                          <th>Auditor</th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php 
                  if ($makerValue == 1) {
                      $smt = $dbh->prepare("SELECT * FROM `$dbnya`.`audit_period`");
                      $smt->execute();
                      $sql = $smt->fetchAll();
                    foreach ($sql as $row):?>
                    <tr>
                          <td><?php echo ($row['period_name'])?> </td>
                          <td><?php echo ($row['period_start'])?></td>
                          <td><?php echo ($row['period_end'])?></td> 
                          <td><?php echo ($row['created_by'])?></td> </tr>
                    <?php  endforeach; 
                    $stmt = $dbh->prepare("SELECT MAX(period_id) AS max_id FROM `$dbnya`.`audit_period`");
                    $stmt -> execute();
                    $invNum = $stmt -> fetch(PDO::FETCH_ASSOC);
                    $max_id = $invNum['max_id'];
                  } else if ($makerValue == 2){
                    $smt = $conn->prepare("SELECT * FROM $dbnya.[dbo].[audit_period]");
                      $smt->execute();
                      $sql = $smt->fetchAll();
                    foreach ($sql as $row):?>
                    <tr>
                          <td><?php echo ($row['period_name'])?> </td>
                          <td><?php echo ($row['period_start'])?></td>
                          <td><?php echo ($row['period_end'])?></td> 
                          <td><?php echo ($row['created_by'])?></td> </tr>
                    <?php  endforeach; 
                    $stmt = $conn->prepare("SELECT MAX(period_id) AS max_id FROM $dbnya.[dbo].[audit_period]");
                    $stmt -> execute();
                    $invNum = $stmt -> fetch(PDO::FETCH_ASSOC);
                    $max_id = $invNum['max_id'];
                  } 
                   ?>
                  </tbody>
              </table>       
          </div>
          <div class="row">
            <div class="col-xs-5 pull-left">
              <a href="#" onclick="history.go(-1)" class="previous">&laquo; Previous</a>
            </div>
            <div class="col-xs-1"></div>
            
            <?php if ($sql){?>
            <div class="col-xs-5 pull-right">
                <button name="usep" type="submit" class="btn btn-primary btn-block btn-flat">Use the last period</button>
            </div>
            <?php } ?>
            <!-- <div class="col-xs-4 pull-right">
              <button class="btn btn-primary btn-block btn-flat">Create new period</button>
            </div> -->
          </div>
        </form>
        </div>
        <div id="menu1" class="tab-pane fade">
          <form method="post" action="">
            <div class="form-group has-feedback">
              <br/>
              <label>Period Name:</label>
              <input type="text" class="form-control" name="period_name" id="period_name" placeholder="Period Name" />
            </div>
            <div class="form-group has-feedback">
              <!-- <div class="col-md-7">   -->
              <label>Period start:</label>
              <input type="text" name="period_start" id="period_start" class="form-control" placeholder="Period Start" />
              <!-- </div>  -->
            </div>
            <div class="form-group has-feedback">
              <!-- <div class="col-md-7">   -->
              <label>Period end:</label>
              <input type="text" name="period_end" id="period_end" class="form-control" placeholder="Period End" />
              <!-- </div>   -->
            </div><br />

            <div class="form-group has-feedback">
              <div class="row">
                <div class="col-xs-4 pull-right">
                  <button type="submit" name="submit" id="submit"  class="btn btn-primary btn-block btn-flat">Create</button>
                </div>
                <div style="clear:both"></div>                 
                <br />  
              </div>
            </div>
          </form>
        </div>
    <!-- /.login-box-body -->
  </div>
</body>

<?php
    $posted = false;
    ?>
<?php 
if(isset($_POST["failed"])){
  echo "<script type='text/javascript'>
  alert('Are you sure want to use this period?');
  window.location = './period.php?id=$makerValue&usedb=$dbaudit&dbtarget=$dbtarget#menu1';
  </script>";
}

if(isset($_POST["usep"])){
  $_SESSION["period"] = $max_id;
  echo "<script type='text/javascript'>
  alert('Are you sure want to use this period?');
  window.location = './index2.php?id=$makerValue&usedb=$dbnya';
  </script>"; 
}
if(isset($_POST["period_start"], $_POST["period_end"], $_POST["period_name"])) {  
  $name = $_POST["period_name"];
  $start = $_POST["period_start"];
  $end = $_POST["period_end"];
  $username = $user["username"]; 

  if ($makerValue == 1) {
      $dbh = new PDO("mysql:host=$host", $dbuser, $password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 

      $query = "INSERT INTO `$dbnya`.`audit_period` (period_name, period_start, period_end, created_by)
                  VALUES ('$name', '$start', '$end', '$username')";
      $period= $dbh->exec($query);
      $posted = true;
      
      if ($posted == true) {
        $period = $dbh->lastInsertId();
        // echo $period;
        // die;
        $_SESSION["period"] = $period;
          echo "<script type='text/javascript'>
            alert('Period created successfully with the name $name');
            window.location = './index2.php?id=$makerValue&usedb=$dbnya';
          </script>";
      } else if ($posted == false) {
          echo "<script type='text/javascript'>alert('Please fill all of form!')</script>";
      }
    // } catch (PDOException $e) {
    //   echo "Choose audit period!";
    // }
  } else if ($makerValue == 2) {
    // try{
      $conn = new PDO("sqlsrv:server=$server", $pwd);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
      $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 

      $sql = "INSERT INTO $dbnya.[dbo].[audit_period] (period_name, period_start, period_end, created_by) VALUES (?,?,?,?)";
      $stmt= $conn->prepare($sql);
      $stmt->execute([$name, $start, $end, $username]);
      $posted = true;
      if ($posted == true) {
        $period = $conn->lastInsertId();
        $_SESSION["period"] = $period;
          echo "<script type='text/javascript'>
            alert('Period created successfully with the name $name');
            window.location = './index2.php?id=$makerValue&usedb=$dbnya';
          </script>";
      } else if ($posted == false) {
          echo "<script type='text/javascript'>alert('Please fill all of form!')</script>";
      }
      // } catch (PDOException $e) {
      //   echo "Choose audit period!";
      // }
      }
    }
?>
<script>
  $(document).ready(function () {
    $.datepicker.setDefaults({
      dateFormat: 'yy-mm-dd'
    });
    $(function () {
      $("#period_start").datepicker();
      $("#period_end").datepicker();
    });
    //      $('#submit').click(function(){  
    //           var period_start = $('#period_start').val();  
    //           var period_end = $('#period_end').val();  
    //           var period_name = $('#period_name').val();
    //     //       if(period_start = '' && period_end = '' && period_name = '' )  
    //     //       {  
    //     //         alert("Please Select Date");  }

    //     //       //   $.ajax({  
    //     //       //           url:"q-period.php",  
    //     //       //           method:"POST",  
    //     //       //           data:{period_start:period_start, period_end:period_end, period_name:period_name},  
    //     //       //      });  
    //     //       // }  
    //     //       // else  
    //     //       // {  
    //     //       //      alert("Please Select Date");  
    //     //       // }  
    //     //  });  
  });  
</script>
<!-- DATA TABLES -->
<script src="/TA2/DBAudit/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/TA2/DBAudit/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
$(function() {
    $('#period').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': true
    })
})
</script>

</html>