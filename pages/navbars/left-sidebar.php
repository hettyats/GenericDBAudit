<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/query/q-sidebar.php'; 
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }
if(isset($_SESSION["user"])){
    $user = $_SESSION["user"];
  }
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/TA2/DBAudit/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $user['name']?></p>
                <!-- Status -->
                <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <li class="treeview">
                <a href="#"><i class="fa fa-exchange"></i> <span>Database Access</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/TA2/DBAudit/pages/database-access/database-access.php?id=<?php echo $makerValue?>&usedb=<?php echo $dbnya?>&period=<?php echo $period?>"><i
                                class="fa fa-circle-o"></i>Database Access
                                <?php if($accessnotif['NotifAccess'] > 0) {?>
                            <span class="pull-right-container">
                                <small class="label pull-right bg-red"><?php echo $accessnotif['NotifAccess'] ?></small>
                            </span>
                            <?php } ?>
                                </a></li>
                    <li><a href="/TA2/DBAudit/pages/database-access/database-usage.php?id=<?php echo $makerValue?>&usedb=<?php echo $dbnya?>&period=<?php echo $period?>"><i
                                class="fa fa-circle-o"></i>Account Usage
                                <?php if($userNotif['NotifUser'] > 0) {?>
                            <span class="pull-right-container">
                                <small class="label pull-right bg-red"><?php echo $userNotif['NotifUser'] ?></small>
                            </span>
                            <?php } ?>
                                </a></li>
                    <li><a href="/TA2/DBAudit/pages/database-access/database-unusual.php?id=<?php echo $makerValue?>&usedb=<?php echo $dbnya?>&period=<?php echo $period?>"><i
                                class="fa fa-circle-o"></i>Database Unusual Access</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-access/failed-login.php?id=<?php echo $makerValue?>&usedb=<?php echo $dbnya?>&period=<?php echo $period?>"><i
                                class="fa fa-circle-o"></i>Database Failed Login</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-users"></i> <span>Database User</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/TA2/DBAudit/pages/database-user/user-list.php?id=<?php echo $makerValue?>&usedb=<?php echo $dbnya?>&period=<?php echo $period?>"><i class="fa fa-circle-o"></i>User List
                    <?php if($userlistNotif['NotifUserList'] > 0) {?>
                            <span class="pull-right-container">
                                <small class="label pull-right bg-red"><?php echo $userlistNotif['NotifUserList'] ?></small>
                            </span>
                            <?php } ?>
                    </a></li>
                    <li><a href="/TA2/DBAudit/pages/database-user/password.php?id=<?php echo $makerValue?>&usedb=<?php echo $dbnya?>&period=<?php echo $period?>"><i class="fa fa-circle-o"></i>
                            User Password Change
                            <?php if($passwordnotif['NotifPassword'] > 0) {?>
                            <span class="pull-right-container">
                                <small class="label pull-right bg-red"><?php echo $passwordnotif['NotifPassword'] ?></small>
                            </span>
                            <?php } ?>
                            </a></li>
                    <li><a href="/TA2/DBAudit/pages/database-user/privilege.php?id=<?php echo $makerValue?>&usedb=<?php echo $dbnya?>&period=<?php echo $period?>"><i class="fa fa-circle-o"></i>
                            Privileges</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-user/role.php?id=<?php echo $makerValue?>&usedb=<?php echo $dbnya?>&period=<?php echo $period?>"><i class="fa fa-circle-o"></i>
                            Roles</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-user/not-active.php?id=<?php echo $makerValue?>&usedb=<?php echo $dbnya?>&period=<?php echo $period?>"><i class="fa fa-circle-o"></i>
                    Inactive User</a></li>
                </ul>
            </li>
            <li><a href="/TA2/DBAudit/pages/report/report.php?id=<?php echo $makerValue?>&usedb=<?php echo $dbnya?>"><i class="fa fa-book"></i> <span>Audit Report</span></a>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>