<?php session_start();
      //Put session start at the beginning of the file
?>
<?php $path = $_SERVER['DOCUMENT_ROOT'].'/TA2/DBAudit'; ?>
<?php 
// include $path.'/pages/navbars/head.php'; 
include $path.'/connection/connection.php';
// include $path.'/redirect.php';
if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
  }
  if (isset($_GET['db'])) {
    $db = $_GET['db'];
  }
  
  if (isset($_GET['id'])) {
    $makerValue = $_GET['id'];
    $_SESSION['id']=$makerValue;
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

           <!-- <form method="POST" > -->
           <div class="form-group has-feedback">
                <div class="col-xs-12">
                    <?php if ($db == 'create') {?>
                        <div class="col-xs-12">
                            <form method="post" action="">
                            <label>Database name: </label>

                            <input type="text" name="db">
                                <select id="cmbMake" class="form-control" name="dbtarget">>
                                    <option disabled selected>Select Database Target </option>
                                    <?php 
                                        if ($makerValue == 1){
                                        $smt = $dbh->prepare("SHOW DATABASES WHERE `Database` NOT LIKE '%audit%'");
                                        $smt->execute();
                                        $mysq = $smt->fetchAll(); ?>
                                    <?php foreach ($mysq as $row): ?>
                                    <option value="<?= $row["Database"]?>"><?=$row["Database"]?></option>
                                    <?php endforeach ?>
                                    <!-- </select> -->
                                    <?php }elseif ($makerValue == 2) {
                                        $stmt = $conn->prepare("select [name] from sys.databases where name NOT LIKE '%audit%'");
                                        $stmt->execute();
                                        $sqls = $stmt->fetchAll(); }
                                        ?>
                                    <?php foreach ($sqls as $row): ?>
                                        <option value="<?= $row["name"]?>"><?=$row["name"]?></option>
                                    <?php endforeach;?>
                                </select>
                                <br>

                                <div class="row">
                                    <div class="col-xs-4 pull-right">
                                        <!-- <input type="hidden" name="selected_text" id="selected_text" /> -->
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">Create</button>
                                    </div>
                                </div>
                            </form>
                    <?php }else{?>
                        <form method="get" action="./index2.php?id=<?=$makerValue ?>">
                        <label>Database name: </label>
                                <select class="form-control" name="usedb" id="cmbMake">
                                    <option disabled selected> Select Database Audit </option>
                                    <?php 
                                        if ($makerValue == 1){
                                        $smt = $dbh->prepare("SHOW DATABASES LIKE '%audit'");
                                        $smt->execute();
                                        $mysq = $smt->fetchAll(); 
                                    foreach ($mysq as $row): ?>
                                        <option value="<?= $row["Database (%audit)"]?>"><?=$row["Database (%audit)"]?></option>
                                    <?php endforeach ?>
                                    <!-- </select> -->
                                    <?php }elseif ($makerValue == 2) {
                                        $stmt = $conn->prepare("select [name] from sys.databases where name LIKE '%audit'");
                                        $stmt->execute();
                                        $sqls = $stmt->fetchAll(); }
                                        ?>
                                    <?php foreach ($sqls as $row): ?>
                                    <option value="<?= $row["name"]?>"><?=$row["name"]?></option>
                                    <?php endforeach; ?>
                                    <!-- </select> -->

                                </select>
                                <div class="row">
                                    <div class="col-xs-4 pull-right">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">Use</button>
                                        <?php }?>

                                    </div>
                                </div>
                        </form>
                        </div>
                </div>
            </div>
            

            <?php  
            
        if(isset($_POST["db"]) && isset($_POST["dbtarget"])){
            $user = $_POST["db"];
            $dbtarget = $_POST["dbtarget"];
            $makerValue = $_GET['id'];
           if ($makerValue == 1) {
               try {
                    $dbh = new PDO("mysql:host=$host", $dbuser, $password);
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
                    $db = $dbh->prepare("CREATE SCHEMA $user".'audit');
                    $db->execute(); 


                    $gen = $dbh->prepare("use mysql");
                    $gen->execute();

                    $genlog = "CREATE TABLE IF NOT EXIST `general_log` (
                        `event_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
                                               ON UPDATE CURRENT_TIMESTAMP,
                        `user_host` mediumtext NOT NULL,
                        `thread_id` bigint(21) unsigned NOT NULL,
                        `server_id` int(10) unsigned NOT NULL,
                        `command_type` varchar(64) NOT NULL,
                        `argument` mediumtext NOT NULL
                       ) ENGINE=CSV DEFAULT CHARSET=utf8 COMMENT='General log'
                       
                        SET @old_log_state = @@GLOBAL.general_log;
                        SET GLOBAL general_log = 'OFF';
                        ALTER TABLE mysql.general_log ENGINE = MYISAM;
                        SET GLOBAL general_log = @old_log_state;


                        SET global general_log = 1;
                        SET global log_output = 'table';";
                    $dbh->exec($genlog); 

                    
                    $ser = $dbh->prepare("use " . $user."audit");
                    $ser->execute();

                    $dbaudit = $user.'audit';

                        $sql = "CREATE TABLE `role_list` (
                            `HOST` char (180),
                            `User` char (240),
                            `Role` char (240),
                            `Admin_option` char (3),
                            `Role_id` mediumint (9),
                            `Create_date` datetime
                        )";
                        $dbh->exec($sql);
    
                         $sql="CREATE VIEW `general_log` AS
                            SELECT `event_time`,
                              `user_host`,
                              `thread_id`,
                              `server_id`,
                              `command_type`,
                              `argument`
                            FROM `mysql`.`general_log`
                            WHERE `argument` LIKE '%$dbtarget%'";
                          $dbh->exec($sql);
    
                        $sql = "CREATE TABLE `privileges_list` AS
                            SELECT 	`GRANTEE`,
                            `TABLE_CATALOG`,
                            `PRIVILEGE_TYPE`,
                            `IS_GRANTABLE`
                            FROM
                            `information_schema`.`USER_PRIVILEGES`
                            LIMIT 0, 1000";
                            $dbh->exec($sql);
    
                        $sql="CREATE TABLE `privileges` AS
                              SELECT 	DISTINCT
                                `PRIVILEGE_TYPE`,
                                `IS_GRANTABLE`
                                FROM
                                `information_schema`.`USER_PRIVILEGES`
                                ORDER BY `PRIVILEGE_TYPE`";
                                $dbh->exec($sql);
    
                        $sql="CREATE TABLE `database_usage` AS SELECT
                            `user_host` AS `Name`,
                            MAX(`event_time`) AS `LastAccess`,
                            COUNT(*) AS `Total`
                            FROM `$dbaudit`.`general_log`
                            GROUP BY `user_host`";
                            $dbh->exec($sql);
    
                        $sql="CREATE VIEW user_list AS
                            SELECT HOST,
                              USER AS username,
                              PASSWORD,
                              PLUGIN AS auth_type,
                              authentication_string,
                              password_expired
                            FROM mysql.user
                            ORDER BY USER";
                            $dbh->exec($sql);
    
                        $sql="CREATE VIEW `count_success_log` AS
                                SELECT
                                `general_log`.`event_time` AS `event_time`,
                                `general_log`.`user_host`  AS `user_host`,
                                COUNT(`general_log`.`event_time`) AS `Total`
                                FROM `$dbaudit`.`general_log`
                                GROUP BY `general_log`.`user_host`";
                                $dbh->exec($sql);
    
                        $sql= "CREATE VIEW `count_failed_login` AS SELECT
                                `general_log`.`event_time` AS `event_time`,
                                `general_log`.`user_host`  AS `user_host`,
                                COUNT(`general_log`.`event_time`) AS `Total`
                                FROM `$dbaudit`.`general_log`
                                WHERE argument LIKE 'Access denied for user%'
                                GROUP BY `general_log`.`user_host`";
                                $dbh->exec($sql);
    
                        $sql= "CREATE VIEW inactive_user AS
                                      SELECT user_host
                                            , MAX(event_time) AS last_acccess
                                        FROM general_log
                                      WHERE CONVERT(MONTH(CURDATE()), INT) - CONVERT(MONTH(event_time), INT) >=3
                                      GROUP BY user_host";
                          $dbh->exec($sql);

                    echo "Database created successfully with the name $user".'audit';
                   ?> <a href="./index2.php?id=<?=$makerValue?>&dbtarget=<?=$dbtarget?>&usedb=<?=$dbaudit?>"> Audit Now <a>

                   <?php
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

                    $pdo_options = array();
                    $pdo_options[PDO::ATTR_EMULATE_PREPARES] = true;
                    $pdo_options[PDO::SQLSRV_ATTR_ENCODING] = PDO::SQLSRV_ENCODING_UTF8;
                    
                    $ser = $conn->prepare("use " . $user."audit");
                    $ser->execute();

                    $dbaudit = $user.'audit';

                    $stmt = $conn->prepare("CREATE TABLE [success_access_log]( 
                        [access_log_id] INT IDENTITY(1,1) NOT NULL PRIMARY KEY, 
                        [spid]   INT   NOT NULL, 
                        [login_name]  VARCHAR(50)  NOT NULL, 
                        [program_name]  VARCHAR(500)  NOT NULL, 
                        [ip_address]  VARCHAR(100)  NOT NULL,  
                        [access_time]  DATETIME  NOT NULL 
                        ) 
                        CREATE INDEX index_access_loginname 
                        ON dbo.success_access_log(login_name) 
                        CREATE INDEX index_access_programname 
                        ON dbo.success_access_log(program_name);",$pdo_options);
                    $stmt->execute();
                    
                    $stmt = $conn->prepare("CREATE TRIGGER [access_log_trigger]
                    ON ALL SERVER FOR LOGON
                    AS
                    
                    BEGIN
                    DECLARE
                    @LogonTriggerData xml,
                    @EventTime datetime,
                    @LoginName varchar(50),
                    @ClientHost varchar(50),
                    @LoginType varchar(50),
                    @HostName varchar(50),
                    @AppName varchar(500)
                    SET @LogonTriggerData = EVENTDATA()
                    SET @EventTime =
                    @LogonTriggerData.value('(/EVENT_INSTANCE/PostTime)[1]','datetime')
                    SET @LoginName =
                    @LogonTriggerData.value('(/EVENT_INSTANCE/LoginName)[1]','varchar(50)
                    ')
                    SET @ClientHost =
                    @LogonTriggerData.value('(/EVENT_INSTANCE/ClientHost)[1]','varchar(50
                    )')
                    SET @HostName = HOST_NAME()
                    SET @AppName = APP_NAME()
                    INSERT INTO $dbaudit.[dbo].success_access_log
                    (
                    login_name,
                    [program_name],
                    access_time,
                    spid,
                    ip_address
                    )
                    SELECT
                    @LoginName,
                    @AppName,
                    @EventTime,
                    @@SPID,
                    client_net_address
                    FROM sys.sysprocesses S
                    INNER JOIN sys.dm_exec_connections decc
                    ON S.spid = decc.session_id
                    WHERE spid = @@SPID
                    END;
                    
                    ENABLE TRIGGER [access_log_trigger] ON ALL SERVER;",$pdo_options);
                    $stmt->execute();
                    
                    $stmt = $conn->prepare("ENABLE TRIGGER access_log_trigger ON ALL SERVER;",$pdo_options);
                    $stmt->execute();
                    
                    // $dbtarget = 'BikeStores';
                    
                    $stmt1 = $conn->prepare("CREATE TABLE [dbo].[failed_access](
                            [id] [int] IDENTITY(1,1) PRIMARY KEY NOT NULL,
                            [LogDate] [datetime] NULL,
                            [ProcessInfo] [varchar](50) NULL,
                            [Text] [varchar](200) NULL);
                            
                            Declare @FailedAccess table(
                            [LogDate] datetime, 
                            [ProcessInfo] nvarchar(20), 
                            [Text] nvarchar(4000)
                        );
                        insert into @FailedAccess([LogDate],[ProcessInfo],[Text]) 
                        exec $dbtarget.sys.sp_readerrorlog 0, 1, 'Login failed';
                    
                        SELECT [LogDate],[ProcessInfo],[Text]
                        FROM @FailedAccess;
                    
                        insert into @FailedAccess([LogDate],[ProcessInfo],[Text]) 
                        exec $dbtarget.sys.sp_readerrorlog 0, 1, 'Login failed';
                    
                    
                        MERGE INTO dbo.failed_access T
                        USING (
                            SELECT [LogDate],[ProcessInfo],[Text]
                            FROM @FailedAccess
                        ) S
                        ON T.LogDate = S.LogDate
                        when NOT MATCHED then
                            insert (LogDate, ProcessInfo, Text)
                            values (S.LogDate, S.ProcessInfo, S.Text)
                        WHEN MATCHED THEN
                            UPDATE 
                            SET LogDate = S.LogDate, 
                                ProcessInfo = S.ProcessInfo,
                                Text = S.Text;",$pdo_options);
                    $stmt1->execute();
                    
                    $stmt2 = $conn->prepare("CREATE VIEW [dbo].[count_success_log] AS
                            SELECT
                            login_name,
                            program_name,
                            DAY(access_time) AS [Day],
                            MONTH(access_time) AS [Month],
                            YEAR(access_time) AS [Year],
                            Count (distinct(access_time)) As [Total]
                            FROM [dbo].[success_access_log]
                            GROUP BY
                            login_name,
                            program_name,
                            YEAR(access_time),
                            MONTH(access_time),
                            DAY(access_time)",$pdo_options);
                    $stmt2->execute();
                    
                    $stmt3 = $conn->prepare("CREATE VIEW database_access_per_day AS
                            SELECT
                            DAY(access_time) AS [Day],
                            MONTH(access_time) AS [Month],
                            YEAR(access_time) AS [Year],
                            COUNT(access_time) AS [Total],
                            login_name
                            FROM success_access_log
                            GROUP BY
                            login_name,
                            YEAR(access_time),
                            MONTH(access_time),
                            DAY(access_time)",$pdo_options);
                    $stmt3->execute();
                    
                    $stmt4 = $conn->prepare("CREATE VIEW [dbo].[database_user] AS 
                            SELECT lg.principal_id, lg.name, lg.type_desc, lg.status, lg.create_date, lg.modify_date, MAX(acc.access_time) AS last_access, CASE WHEN MAX(acc.access_time) IS NULL THEN - 1 ELSE DATEDIFF(MM, 
                                                    MAX(acc.access_time), GETDATE()) END AS duration
                            FROM (SELECT principal_id, name, type_desc, create_date, modify_date, CASE is_disabled WHEN 0 THEN 'Activated' WHEN 1 THEN 'Deactivated' END AS status
                                                    FROM $dbtarget.sys.server_principals
                                                    WHERE (type IN ('S', 'U'))) AS lg LEFT OUTER JOIN
                                                    dbo.success_access_log AS acc ON acc.login_name COLLATE DATABASE_DEFAULT = lg.name COLLATE DATABASE_DEFAULT
                            GROUP BY lg.principal_id, lg.name, lg.type_desc, lg.create_date, lg.modify_date, lg.status",$pdo_options);
                    $stmt4->execute();
                    
                    $stmt5 = $conn->prepare("CREATE VIEW [dbo].[user_password] AS 
                            SELECT principal_id, name, type_desc, LOGINPROPERTY(name, 'PasswordLastSetTime') AS lastsettime, LOGINPROPERTY(name, 'DaysUntilExpiration') AS dayexpiration, LOGINPROPERTY(name, 'PasswordHash') 
                                                    AS passhash, LOGINPROPERTY(name, 'PasswordHashAlgorithm') AS passhashalgo
                            FROM [dbo].[database_user]",$pdo_options);
                    $stmt5->execute();
                    
                    $stmt6 = $conn->prepare("CREATE VIEW [dbo].[inactive_user] AS
                            SELECT [access_log_id]
                                ,[spid]
                                ,[login_name]
                                ,[program_name]
                                ,[ip_address]
                                ,[access_time]
                            FROM [dbo].[success_access_log]
                            WHERE CONVERT(INT, month(getdate()), 111) -CONVERT(INT,month([access_time]), 111) > 2",$pdo_options);
                    $stmt6->execute();
                    
                    $stmt7 = $conn->prepare("CREATE VIEW [dbo].[database_usage] AS 
                            SELECT 
                                login_name as [Name],
                                count(*) as [Total]
                            FROM $dbaudit.dbo.success_access_log
                            GROUP BY login_name",$pdo_options);
                    $stmt7->execute();
                    
                    $stmt8 = $conn->prepare("CREATE VIEW [dbo].[not_change_password] AS
                            SELECT [principal_id]
                                ,[name]
                                ,[type_desc]
                                ,[lastsettime]
                                ,[dayexpiration]
                                ,[passhash]
                                ,[passhashalgo]
                            FROM $dbaudit.[dbo].[user_password]
                            WHERE (datediff(MM,convert(datetime,lastsettime), getdate())) > 2",$pdo_options);
                    $stmt8->execute();
                    
                    $stmt9 = $conn->prepare("Create View [dbo].[privileges] As
                            SELECT DISTINCT permission_name as PermissionName,
                                type,
                                state_desc,
                                class_desc FROM $dbtarget.sys.database_permissions",$pdo_options);
                    $stmt9->execute();
                    
                    $stmt10 = $conn->prepare("CREATE VIEW [dbo].[privilege_list] AS
                            SELECT
                                [UserName] = CASE princ.[type] 
                                                WHEN 'S' THEN princ.[name]
                                                WHEN 'U' THEN ulogin.[name] COLLATE Latin1_General_CI_AI
                                            END,
                                [UserType] = CASE princ.[type]
                                                WHEN 'S' THEN 'SQL User'
                                                WHEN 'U' THEN 'Windows User'
                                            END,  
                                [DatabaseUserName] = princ.[name],       
                                [Role] = null,      
                                [PermissionType] = perm.[permission_name],       
                                [PermissionState] = perm.[state_desc],       
                                [ObjectType] = obj.type_desc,--perm.[class_desc],
                                [ObjectName] = obj.name, 
                                [ColumnName] = col.[name]
                            FROM    
                                --database user
                                $dbtarget.sys.database_principals princ  
                            LEFT JOIN
                                --Login accounts
                                $dbtarget.sys.login_token ulogin on princ.[sid] = ulogin.[sid]
                            LEFT JOIN        
                                --Permissions
                                $dbtarget.sys.database_permissions perm ON perm.[grantee_principal_id] = princ.[principal_id]
                            LEFT JOIN
                                --Table columns
                                $dbtarget.sys.columns col ON col.[object_id] = perm.major_id 
                                                AND col.[column_id] = perm.[minor_id]
                            LEFT JOIN
                                $dbtarget.sys.objects obj ON perm.[major_id] = obj.[object_id]
                            WHERE 
                                princ.[type] in ('S','U')",$pdo_options);
                    $stmt10->execute();
                    
                    $stmt = $conn->prepare("CREATE VIEW [dbo].[role_list] AS
                            SELECT name, principal_id, type, type_desc, default_schema_name, create_date, modify_date, owning_principal_id, sid, is_fixed_role, authentication_type, authentication_type_desc, default_language_name, 
                                                    default_language_lcid
                            FROM $dbtarget.sys.database_principals",$pdo_options);
                    $stmt->execute();
                    
                    $stmt = $conn->prepare("CREATE VIEW [dbo].[user_list] AS
                    SELECT        name AS username, create_date, modify_date, type_desc AS type, authentication_type_desc AS authentication_type
                    FROM            $dbtarget.sys.database_principals",$pdo_options);
                    $stmt->execute();
                    
                    $stmt = $conn->prepare("CREATE VIEW [dbo].[user_outside_operating_hour] AS
                            SELECT        login_name, program_name, ip_address, access_time
                            FROM            dbo.success_access_log
                            WHERE        (CONVERT(time, access_time) < CONVERT(time, '08:00:00', 105)) OR
                                                    (CONVERT(time, access_time) > CONVERT(time, '19:00:00', 105))",$pdo_options);
                    $stmt->execute();
                    
                    $stmt = $conn->prepare("CREATE VIEW [dbo].[count_outside_operating_hour] AS
                            SELECT
                            login_name, Count (distinct(access_time)) As [Total], MAX(access_time) as [last_access]
                            FROM
                            [dbo].[user_outside_operating_hour]
                            GROUP BY
                            login_name",$pdo_options);
                    $stmt->execute();
                    
                    $stmt = $conn->prepare("CREATE VIEW [dbo].[count_failed_login] AS
                            SELECT CAST(error_message AS varchar(MAX)) AS Text, COUNT(error_date) AS count, MAX(error_date) AS date
                            FROM dbo.error_log
                            WHERE (error_message LIKE '%Login failed for user%')
                            GROUP BY CAST(error_message AS varchar(MAX))",$pdo_options);
                    $stmt->execute();

                    // unset($stmt);
                    // unset($conn);

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