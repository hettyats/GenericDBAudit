<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php include $path.'/query/q-sidebar.php'; ?>

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
                <p>Admin</p>
                <!-- Status -->
                <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <li class="treeview">
                <a href="/TA2/DBAudit/pages/database-user/user-list.php"><i class="fa fa-users"></i> <span>User List</span>
                    <!-- <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span> -->
                </a>
                <!-- <ul class="treeview-menu">
                    <li><a href="/TA2/DBAudit/pages/database-user/user-list.php"><i class="fa fa-circle-o"></i>User List</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-user/password.php"><i class="fa fa-circle-o"></i>
                            User Password Change</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-user/privilege.php"><i class="fa fa-circle-o"></i>
                            Privileges</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-user/role.php"><i class="fa fa-circle-o"></i>
                            Roles</a></li>
                </ul> -->
            </li>
            <li><a href="/TA2/DBAudit/pages/report/report.php"><i class="fa fa-book"></i> <span>Audit Report</span></a>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>