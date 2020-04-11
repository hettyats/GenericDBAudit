<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/pages/navbars/head.php'; ?>
<?php
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  } 

?>


<div class="wrapper">

    <?php include $path.'/pages/navbars/top-navbar.php'; ?>
    <?php include $path.'/pages/navbars/left-sidebar.php'; ?>

    <!-- HEADER and BREADCRUMB -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Database Audit: <?php if ($makerValue == 1) {?>Northwind
                    <?php } else { ?>BikeStores
                <?php }?>
                <!-- <small>Optional description</small> -->
            </h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i>Home</li>
                <!-- <li class="active">Here</li> -->
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!-- DATABASE ACCESS -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-solid">
                        <div class="box-header">
                            <h3 class="box-title">Database Access</h3>
                            <div class="box-tools pull-right">
                                <a href="">View Detail</a>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="accessChart" style="height:250px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include $path.'/pages/navbars/footer.php'; ?>
    <?php include $path.'/pages/navbars/control-sidebar.php'; ?>

</div>
<!-- ./wrapper -->

<?php include $path.'/pages/navbars/required-scripts.php'; ?>

<!-- CHARTS -->
<?php include $path.'/charts/index-charts/index-charts.php'; ?>

<?php include $path.'/pages/navbars/end.php'; ?>
