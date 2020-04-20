<!-- Main Header -->
<header class="main-header">
<?php if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }
?>
    <!-- Logo -->
    <a href="/TA2/DBAudit/index2.php?id=<?php echo $makerValue?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">DBAT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">DB Audit Tool</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="/TA2/DBAudit/index.php?">Choose Database <i class="fa fa-database"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>