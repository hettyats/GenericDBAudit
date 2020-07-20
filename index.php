<?php session_start();
if(!isset($_SESSION["user"])) header("Location: login.php");
// echo $user["username"];
if(isset($_SESSION["user"])){
  $user = $_SESSION["user"];
}


$path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php 
// include $path.'/pages/navbars/head.php'; 
include $path.'/connection/connection.php';?>


<!DOCTYPE html>
<html style="height: auto;">
<style type="text/css">
body{
  background-repeat: no-repeat;
  /* background-attachment: fixed; */
  background-size: cover;
}
</style>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Database Audit Tool | RDBMS</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php $path ?>./bower_components/bootstrap/dist/css/bootstrap.min.css">
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
</head>

<body class="hold-transition login-page" style=" background-size: cover;">
    <div class="login-box">
      <!-- /.login-logo -->
      
        <div class="login-box-body" style="position:fixed;width:400px">
        <!-- <h1 style="background-color:coral;font-family:courier;font-size: 25px;position: center; top: 0px;"><center><b>DATABASE AUDIT TOOL</b></center></h1> -->
          <!-- <p class="login-box-msg">Sign in to start your session</p> -->
          <!-- <form method="POST" action = "./index2.php"> -->
           <form method="get" action = "./choose_db.php">
           <div class="login-logo">
          <a href="./index.php"><b>Database Audit Tool</b></a><hr>
        </div>
            <div class="form-group has-feedback">
              <!-- <div class="col-xs-12"> -->
              <h3><center>Choose your RDBMS</center></h3>
              <label>Select RDBMS </label>
                  <select id="cmbMake" class="form-control" name="id" >
                  
                    <option value="1">MySQL</option>
                    <option value="2">Ms. SQL Server</option>
                  </select>
                  <br/>
                  <label>Action</label>
                  <select id="cmbMake" class="form-control" name="db" >
                      <!-- <option value="0">Select RDBMS</option> -->
                      <option value="create">Create a New Database Audit</option>
                      <option value="use">Use an exist Database Audit</option>
                  </select>
                  <br/>
                  <div class="row">
                    <div class="col-xs-4 pull-right">
                      <!-- <input type="hidden" name="selected_text" id="selected_text" /> -->
                      <button type="submit" class="btn btn-primary btn-block btn-flat">Next</button>
                    </div>
                  </div>
              <!-- </div> -->
            </div>
            </form>
        </div>
    <!-- /.login-box-body -->
    </div>
</body>

</html>