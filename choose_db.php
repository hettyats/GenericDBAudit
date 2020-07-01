<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php 
// include $path.'/pages/navbars/head.php'; 
include $path.'/connection/connection.php';
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }
  if (isset($_GET['db'])) {
    $db = $_GET['db'];
  }

//   $GLOBALS['id'] = $_GET['id'];
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
        <div class="login-logo">
          <a href="./index.php"><b>Use Database</b></a>
        </div>
      <!-- /.login-logo -->
        <div class="login-box-body">
          <!-- <p class="login-box-msg">Sign in to start your session</p> -->
          <!-- <form method="POST" action = "./index2.php"> -->
          <form method="POST" action="./index2.php?id=<?php echo $makerValue?>">
            <div class="form-group has-feedback">
                <div class="col-xs-12">
                <?php if ($db == 'create') {?>
                    <label>Database name: </label>
                    <input type="text" name="db">
                    <div class="row">
                        <div class="col-xs-4 pull-right">
                        <!-- <input type="hidden" name="selected_text" id="selected_text" /> -->
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Create</button>
                        </div>
                    </div>
                <?php }else{?>
                    <select class="form-control" name="usedb" id="cmbMake" method="get" action="./index2.php?id=<?php echo $makerValue ?>">
                        <option disabled selected> Select Database Audit </option>
                        <?php 
                        if ($makerValue == 1){
                        $smt = $dbh->prepare("SHOW DATABASES LIKE '%audit'");
                        $smt->execute();
                        $mysq = $smt->fetchAll(); ?>
                         <?php foreach ($mysq as $row): ?>
                            <option><?=$row["Database (%audit)"]?></option>
                        <?php endforeach ?>
                        <!-- </select> -->
                         <?php }elseif ($makerValue == 2) {
                        $stmt = $conn->prepare("select [name] from sys.databases where name LIKE '%audit'");
                        $stmt->execute();
                        $sqls = $stmt->fetchAll(); }
                        ?>
                         <?php foreach ($sqls as $row): ?>
                            <option><?=$row["name"]?></option>
                         <?php endforeach; 
                        ?>
                        <!-- </select> -->
                       
                    </select>
                    <div class="row">
                    <div class="col-xs-4 pull-right">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Use</button> <?php }?>
                        </div>
                  </div>
                </div>
            </div>
        </form>
        
    <?php  
        if(isset($_POST["db"])){
            $user = $_POST["db"];
            // echo $user;
           if ($makerValue == 1) {
               try {
                    $dbh = new PDO("mysql:host=$host", $dbuser, $password);
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
                    $db = $dbh->prepare("CREATE SCHEMA $user".'audit');
                    $db->execute(); 
                    echo "Database created successfully with the name $user".'audit';
                    // echo "Connected successfully";
                    }
                catch (PDOException $e) {
                    echo $e->getMessage();
                }
                // $dbh = null;
            }elseif ($makerValue == 2) {
                try {
                    $conn = new PDO("sqlsrv:server=$server", $pwd);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
                    $ser = $conn->prepare("CREATE DATABASE"."[$user".'audit]');
                    $ser->execute(); 
                    echo "Database created successfully with the name $user".'audit';
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        }
    ?>
        </div>
    <!-- /.login-box-body -->
    </div>
</body>

</html>