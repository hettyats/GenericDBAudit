<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php 
// include $path.'/pages/navbars/head.php'; 
include $path.'/connection/connection.php';
// include $path.'/q-period.php';

if (isset($_GET['id'])) {
  $makerValue = $_GET['id'];
}
if (isset($_POST['usedb'])) {
  $dbnya = $_POST['usedb'];
  // echo $dbnya;
}
?>


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
      <!-- /.login-logo -->
        <div class="login-box-body">
          <!-- <p class="login-box-msg">Sign in to start your session</p> -->
          <!-- <form method="POST" action = "./index2.php"> -->
              <form method="post" action="./index2.php?id=<?php echo $makerValue ?>&usedb=<?php echo $dbnya?>">
              <div class="login-logo">
                  <a href="./index.php"><b>Audit Period</b></a>
              </div>
              <div class="form-group has-feedback">
                  <select id="cmbMake" class="form-control" name="period">>
                      <option disabled selected>Select an exists period</option>
                      <?php 
                          $smt = $dbh->prepare("SELECT * FROM `databaseaudit`.`audit_period`");
                          $smt->execute();
                          $mysq = $smt->fetchAll(); ?>
                      <?php foreach ($mysq as $row): ?>
                        <optgroup label="<?= $row["period_name"]?>">
                          <option value="<?= $row["period_id"]?>"><b>Start date :</b><?=$row["period_start"]?><b>End date : </b><?=$row["period_end"]?></option>
                        </optgroup>
                      <?php endforeach ?>
                      <!-- </select> -->
                  </select>
                  <br>
              </div>

              <div class="row">
                  <div class="col-xs-4 pull-right">
                      <!-- <input type="hidden" name="selected_text" id="selected_text" /> -->
                      <button type="submit" class="btn btn-primary btn-block btn-flat">Audit</button>
                  </div>
              </div>
              </form>
        </div>
    <!-- /.login-box-body -->
    </div>
</body>



</html>