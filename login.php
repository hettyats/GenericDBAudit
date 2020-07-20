<?php session_start();
if(isset($_SESSION["user"])) header("Location: index.php");

$dbuser = 'root';
$password = '';

try {    
  //create PDO connection 
  $db = new PDO("mysql:host=localhost;dbname=dbat", $dbuser, $password);
} catch(PDOException $e) {
  //show error
  die("Terjadi masalah: " . $e->getMessage());
} ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Database Audit Tool | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
   <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/TA2/DBAudit/bower_components/bootstrap/dist/css/bootstrap.min.css">
 <!-- Font Awesome -->
 <link rel="stylesheet" href="/TA2/DBAudit/bower_components/font-awesome/css/font-awesome.min.css">
 <!-- Ionicons -->
 <link rel="stylesheet" href="/TA2/DBAudit/bower_components/Ionicons/css/ionicons.min.css">
 <!-- Theme style -->
 <link rel="stylesheet" href="/TA2/DBAudit/dist/css/AdminLTE.min.css">
 <!-- iCheck -->
 <link rel="stylesheet" href="/TA2/DBAudit/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="login-logo">
      <a href="../../index2.html"><b>Database Audit Tool</b></a><hr>
    </div>
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <label>Username</label>
        <input name="username" type="username" class="form-control" placeholder="Username">
      </div>
      <div class="form-group has-feedback">
        <label>Password</label>
        <input name="password" type="password" class="form-control" placeholder="Password"  autocomplete="off">
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4 pull-right">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="Masuk">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <br/>
    Don't have an account yet? <a href="register.php" class="text-center">Register now</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</body>
</html>

<?php 
if(isset($_POST['login'])){
  try {    
    //create PDO connection 
    $dbh = new PDO("mysql:host=localhost;dbname=dbat", $dbuser, $password);
  } catch(PDOException $e) {
    //show error
    die("Terjadi masalah: " . $e->getMessage());
  }
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $password = md5($_POST['password']);
  // $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  // echo $password;
  // die;

  $sql = "SELECT * FROM users WHERE username=:username and password='$password'";
  $stmt = $dbh->prepare($sql);
  
  // bind parameter ke query
  $params = array(
      ":username" => $username,
      // ":email" => $username
  );

  $stmt->execute($params);

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // jika user terdaftar
  if($user){
          session_start();
          $_SESSION["user"] = $user;
          header("Location: index.php");
  }
}