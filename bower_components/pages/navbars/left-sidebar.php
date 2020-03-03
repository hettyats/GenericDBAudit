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
                <p>Alexander Pierce</p>
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
                    <li><a href="/TA2/DBAudit/pages/database-access/database-access.php"><i
                                class="fa fa-circle-o"></i>Database Access</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-access/database-usage.php"><i
                                class="fa fa-circle-o"></i>Account Usage</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-access/database-unusual.php"><i
                                class="fa fa-circle-o"></i>Database Unusual Access</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-users"></i> <span>Database User</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/TA2/DBAudit/pages/database-user/user-list.php"><i class="fa fa-circle-o"></i>                            User List</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-user/password.php"><i class="fa fa-circle-o"></i>
                            User Password Change</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-user/privilege.php"><i class="fa fa-circle-o"></i>
                            Privileges</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-user/role.php"><i class="fa fa-circle-o"></i>
                            Roles</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-warning"></i> <span>Database Error</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/TA2/DBAudit/pages/database-error/failed-login.php"><i
                                class="fa fa-circle-o"></i>Database Failed Login</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-error/syntax.php"><i class="fa fa-circle-o"></i>Syntax
                            Error</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-error/invalid-object.php"><i
                                class="fa fa-circle-o"></i>Invalid Object Error</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-error/operator.php"><i class="fa fa-circle-o"></i>Union
                            Operator Error</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-error/permission.php"><i
                                class="fa fa-circle-o"></i>Permission Error</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-error/conversion.php"><i
                                class="fa fa-circle-o"></i>Conversion Error</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-list-alt"></i><span>Database Objects</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/TA2/DBAudit/pages/database-object/db-tables.php"><i
                                class="fa fa-circle-o"></i>Database Tables</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-object/db-views.php"><i class="fa fa-circle-o"></i>Database
                            Views
                            <?php if($viewNotif['NotifView'] > 0) {?>
                            <span class="pull-right-container">
                                <small class="label pull-right bg-red"><?php echo $viewNotif['NotifView'] ?></small>
                            </span>
                            <?php } ?>
                        </a>
                    </li>
                    <li><a href="/TA2/DBAudit/pages/database-object/db-functions.php"><i
                                class="fa fa-circle-o"></i>Database Functions</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-object/db-sprocedures.php"><i
                                class="fa fa-circle-o"></i>Database Stored Procedures
                        </a>
                    </li>
                    <li><a href="/TA2/DBAudit/pages/database-object/db-triggers.php"><i
                                class="fa fa-circle-o"></i>Database Triggers</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-line-chart"></i> <span>DDL Activity</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/TA2/DBAudit/pages/database-ddl/ddl-activity.php"><i class="fa fa-circle-o"></i>DDL
                            Activities</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-ddl/ddl-users.php"><i class="fa fa-circle-o"></i>DDL
                            Users</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-ddl/ddl-type.php"><i class="fa fa-circle-o"></i>DDL
                            Types</a></li>
                    <li><a href="/TA2/DBAudit/pages/database-ddl/ddl-change.php"><i class="fa fa-circle-o"></i>Permission
                            Change</a></li>

                </ul>
            </li>
            <li><a href="/TA2/DBAudit/pages/report/report.php"><i class="fa fa-book"></i> <span>Audit Report</span></a>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>