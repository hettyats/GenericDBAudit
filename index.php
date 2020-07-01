<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php 
// include $path.'/pages/navbars/head.php'; 
include $path.'/connection/connection.php';?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
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

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
          <a href="./index.php"><b>Choose your Database</b></a>
        </div>
      <!-- /.login-logo -->
        <div class="login-box-body">
          <!-- <p class="login-box-msg">Sign in to start your session</p> -->
          <!-- <form method="POST" action = "./index2.php"> -->
           <form method="get" action = "./choose_db.php">
            <div class="form-group has-feedback">
              <div class="col-xs-12">
                <!-- <form method="POST" > -->
                  <label>RDBMS : </label>
                    <select id="cmbMake" class="form-control" name="id" >
                      <option disabled selected>Select RDBMS </option>
                      <option value="1">MySQL</option>
                      <option value="2">Ms. SQL Server</option>
                    </select>
                  <br/>
                  <select id="cmbMake" class="form-control" name="db" >
                      <!-- <option value="0">Select RDBMS</option> -->
                      <option value="create">Create a New Database Audit</option>
                      <option value="use">Use an exist Database Audit</option>
                    </select>
                  <br/>
                  <div class="row">
                    <div class="col-xs-4 pull-right">
                      <!-- <input type="hidden" name="selected_text" id="selected_text" /> -->
                      <button type="submit" class="btn btn-primary btn-block btn-flat">Audit</button>
                    </div>
                  </div>
                </form>
                <?php
                //onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text"
                  // if(isset($_GET['search']))
                  // {
                  //     $makerValue = $_GET['search'];
                      // $makerValue = $_POST['Make']; // make value
                      // $dbh = new PDO("mysql:host=$host;dbname=$db", $dbuser, $password);
                      // $conn = new PDO("sqlsrv:server=$server", $pwd);
                      // if ($makerValue == 1){
                      // $maker = mysqli_real_escape_string($dbh, $_POST['selected_text']); // get the selected text
                      // } else if ($makerValue == 2) {
                      //   $maker = mysqli_real_escape_string($conn, $_POST['selected_text']); 
                      // }
                      // $bool=true;
                      // $db1 = "Northwind";
                      // $db2 = "BikeStores";
                     
                      // if (isset($_GET['search'])) {
                      //   $makerValue = $_GET['search'];
                      // }
                  //} ?>
              </div>
            </div>
        </div>
    <!-- /.login-box-body -->
    </div>
</body>

</html>