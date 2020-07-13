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
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php $path ?>./bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- <style type="text/css">
  .demo { position: relative; }
  .demo i {
    position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;
  }
  </style> -->
 
<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
</head>

<body class="hold-transition login-page">
    <div class="login-box">
      <!-- /.login-logo -->
        <div class="login-box-body">
          <!-- <p class="login-box-msg">Sign in to start your session</p> -->
          <!-- <form method="POST" action = "./index2.php"> -->
          <form method="post" action="">
              <div class="login-logo">
                  <a href="./index.php"><b>Audit Period</b></a>
              </div>
              <div class="form-group has-feedback">
              <input type="text" name="daterange" value="01/01/2015 - 01/31/2015" />
              <script type="text/javascript">
              $(function() {
                  $('input[name="daterange"]').daterangepicker();
              });
              </script>
               <h3 align="center">Order Data</h3><br />  
                <div class="col-md-3">  
                     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  
                </div>  
                <div class="col-md-3">  
                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />  
                </div>  
                <div class="col-md-5">  
                     <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />  
                </div>  
                <div style="clear:both"></div>                 
                <br />  
              </div>
              <div class="form-group has-feedback">
                  <select id="cmbMake" class="form-control" name="dbtarget">>
                      <option disabled selected>Select an exists period</option>
                      <?php 
                          $smt = $dbh->prepare("SELECT * FROM `databaseaudit`.`audit_period`");
                          $smt->execute();
                          $mysq = $smt->fetchAll(); ?>
                      <?php foreach ($mysq as $row): ?>
                        <optgroup label="<?= $row["period_name"]?>">
                          <option value="<?= $row["period_name"]?>"><b>Start date :</b> <?=$row["period_start"]?>  <b>End date : </b><?=$row["period_end"]?></option>
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
<script>  
      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });  
           $(function(){  
                $("#from_date").datepicker();  
                $("#to_date").datepicker();  
           });  
           $('#filter').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:"q-period.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                               $('#order_table').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
      });  
 </script>



</html>