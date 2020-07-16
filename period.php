<?php session_start();

$path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php 
// include $path.'/pages/navbars/head.php'; 
include $path.'/connection/connection.php';
// include $path.'/q-period.php';

// if (isset($_GET['id'])) {
//   $makerValue = $_GET['id'];
//   echo $makerValue;
// }
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
?>


<!DOCTYPE html>
<html>
<style type="text/css">
  body {
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
  }
</style>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
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
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body" style="background-color:White; position:fixed;">

      <!-- <p class="login-box-msg">Sign in to start your session</p> -->
      <!-- <form method="POST" action = "./index2.php"> -->
      <div class="login-logo">
      <a href="./index.php"><b>DATABASE AUDIT TOOL</b></a>
        <h3>Audit Period</h3>
      </div>
      <h6>
        <ol class="breadcrumb">
          <li><a href="/TA2/DBAudit/index.php"></i>Choose RDBMS</a></li>
          <li><a href="/TA2/DBAudit/index.php?id=<?php echo $makerValue?>">Choose Database Audit</a></li>
          <li class="active"><u>Choose Period</u></li>
        </ol>
      </h6>
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Select an exists period</a></li>
        <li><a data-toggle="tab" href="#menu1">Create New audit</a></li>
      </ul>

      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
        <form method="post" action="./index2.php?id=<?php echo $makerValue?>&usedb=<?php echo $dbnya?>">
            <div class="form-group has-feedback">
              <br/>
              <label>Period:</label>
              <select id="cmbMake" class="form-control" name="period">>
                <option disabled selected>Select period</option>
                <?php if ($makerValue == 1){
                          $smt = $dbh->prepare("SELECT * FROM `$dbnya`.`audit_period`");
                          $smt->execute();
                          $mysq = $smt->fetchAll(); ?>
                <?php foreach ($mysq as $row): ?>
                <optgroup label="<?= $row["period_name"]?>">
                  <option value="<?= $row["period_id"]?>"><b>Start date :</b> <?=$row["period_start"]?> <b>End date :
                    </b><?=$row["period_end"]?></option>
                </optgroup>
                <?php endforeach ?>
                <!-- </select> -->
                <?php }elseif ($makerValue == 2) {
                          $stmt = $conn->prepare("SELECT * from $dbnya.dbo.audit_period");
                          $stmt->execute();
                          $sqls = $stmt->fetchAll(); }
                          ?>
                <?php foreach ($sqls as $row): ?>
                <optgroup label="<?= $row["period_name"]?>">
                  <option value="<?= $row["period_id"]?>"><b>Start date :</b> <?=$row["period_start"]?> <b>End date :
                    </b><?=$row["period_end"]?></option>
                </optgroup>
                <?php endforeach;?>
              </select>
              <br>
            </div>

            <div class="row">
              <div class="col-xs-4 pull-right">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Audit</button>
              </div>
            </div>
          </form>
        </div>
        <div id="menu1" class="tab-pane fade">
          <form method="post" action="">
            <div class="form-group has-feedback">
              <br/>
              <label>Period Name:</label>
              <input type="text" class="form-control" name="period_name" id="period_name" value=""
                placeholder="Period Name" />
            </div>
            <div class="form-group has-feedback">
              <!-- <div class="col-md-7">   -->
              <label>Period start:</label>
              <input type="text" name="period_start" id="period_start" class="form-control"
                placeholder="Period Start" />
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
                  <button type="submit" name="submit" id="submit"
                    class="btn btn-primary btn-block btn-flat">Create</button>
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
if(isset($_POST["period_start"], $_POST["period_end"], $_POST["period_name"]))  
{  $name = $_POST["period_name"];
  $start = $_POST["period_start"];
  $end = $_POST["period_end"];
  if ($makerValue == 1) {
    try{
      $dbh = new PDO("mysql:host=$host", $dbuser, $password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
      $gen = $dbh->prepare("use $dbnya");
                  $gen->execute();
      $query = $dbh->prepare("INSERT INTO `audit_period` (period_name, period_start, period_end)
                  VALUES ('$name', '$start', '$end')");
      $query->execute();
      $posted = true;
      if ($posted == true) {
          echo "<script type='text/javascript'>
            alert('Period created successfully with the name $name');
            location.reload();
          </script>";
      } else if ($posted == false) {
          echo "<script type='text/javascript'>alert('Please choose database target!')</script>";
      }
    } catch (PDOException $e) {
      echo "Choose audit period";}
  } else if ($makerValue == 2) {
    try{
      $conn = new PDO("sqlsrv:server=$server", $pwd);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
      $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
      
      $ser = $conn->prepare("use $dbnya");
      $ser->execute();

      $sql = "INSERT INTO [dbo].[audit_period] (period_name, period_start, period_end) VALUES (?,?,?)";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$name, $start, $end]);
    $posted = true;
    if ($posted == true) {
        echo "<script type='text/javascript'>
          alert('Period created successfully with the name $name');
          location.reload();
        </script>";
    } else if ($posted == false) {
        echo "<script type='text/javascript'>alert('Please choose database target!')</script>";
    }
    } catch (PDOException $e) {
      echo "Choose your audit period";}
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


</html>