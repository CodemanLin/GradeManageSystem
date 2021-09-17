<?php
header("Content-Type: text/html;charset=utf-8");
session_start();
if (!isset($_SESSION['admin_name'])) {
    header("Location:login.html");
    exit('非法访问！');
}
require_once('mysql_connect.php');
?>
<!DOCTYPE html>
<head>
    <title>管理员界面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/font.css" type="text/css"/>
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <script src="js/jquery2.0.3.min.js"></script>
</head>
<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="index_admin.php" class="logo">
                    管理员
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu" >
                    <!-- settings start -->
                    <?php
                    
                    $sql = "select course_id,flag from grade where flag='1' group by course_id";
                    $num = mysqli_num_rows(mysqli_query($conn,$sql));
                    ?>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-success"><?php echo $num; ?></span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <li>
                                <?php
                                if ($num) {
                                    echo "<p>您有" . $num . "个成绩确认任务</p>";
                                } else {
                                    echo "<p>当前无确认任务</p>";
                                }
                                ?>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="top-nav clearfix">
                <ul class="nav pull-right top-menu" >
                   
                    <li class="dropdown" >
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="images/2.png">
                            <span class="username">Admin</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="admin_xgmm.php"><i class="fa fa-cog"></i> 修改密码</a></li>
                            <li><a href="index_admin.php?action=logout"><i class="fa fa-key"></i> 注销</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="index_admin.php">
                                <i class="fa fa-dashboard"></i>
                                <span>首页</span>
                            </a>
                        </li>


                        
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-tasks"></i>
                                <span>添加学生</span>
                            </a>
                            <ul class="sub">
                                <li><a href="admin_addy.php">单个添加</a></li>
                                <li><a href="admin_addd.php">批量添加</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-user"></i>
                                <span>添加老师</span>
                            </a>
                            <ul class="sub">
                                <li><a href="admin_addly.php">单个添加</a></li>
                                <li><a href="admin_addld.php">批量添加</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-envelope"></i>
                                <span>添加课程</span>
                            </a>
                            <ul class="sub">
                                <li><a href="admin_addcy.php">单个添加</a></li>
                                <li><a href="admin_addcd.php">批量添加</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class=" fa fa-bar-chart-o"></i>
                                <span>审核成绩</span>
                            </a>
                            <ul class="sub">
                                <li><a href="admin_wshcj.php">未审核信息</a></li>
                                <li><a href="admin_yshcj.php">已审核信息</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class=" fa fa-bar-chart-o"></i>
                                <span>查询成绩及统计</span>
                            </a>
                            <ul class="sub">
                                <li><a href="admin_cxcjkh.php">按课号查询</a></li>
                                <li><a href="admin_cxcjxh.php">按学号查询</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-glass"></i>
                                <span>查询信息</span>
                            </a>
                            <ul class="sub">
                                <li><a href="admin_selstu.php">查询学生信息</a></li>
                                <li><a href="admin_seltea.php">查询老师信息</a></li>
                                <li><a href="admin_selcou.php">查询课程信息</a></li>
                            </ul>
                        </li>
                        
                    </ul>            </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <div class="table-agile-info">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            审核成绩
                        </div>
                        <div>
                            <form  action="admin_dsure.php?action=submit" method="post">
                                <input type="hidden" name="course_id" value="<?php echo $_GET['flag']; ?>" />
                                <table class="table" ui-jq="footable" ui-options='{
                                       "paging": {
                                       "enabled": true
                                       },
                                       "filtering": {
                                       "enabled": true
                                       },
                                       "sorting": {
                                       "enabled": true
                                       }}'>
                                    <thead>
                                        <tr>
                                            <th data-breakpoints="xs">学号</th>
                                            <th>姓名</th>
                                            <th>专业</th>
                                            <th>平时成绩</th>
                                            <th>考试成绩</th>
                                            <th>总分</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $a = $_GET['flag'];
                                        
                                        $sql = "select * from grade,student where student.stuno=grade.stuno and grade.course_id='$a'";
                                       
                                        $res = mysqli_query($conn,$sql);
                                        while ($arr = mysqli_fetch_array($res)) {
                                            echo "<tr data-expanded='true'>";
                                            echo "<td>" . $arr['stuno'] . "</td>";
                                            echo "<td>" . $arr['name'] . "</td>";
                                            echo "<td>" . $arr['ps'] . "</td>";
                                            echo "<td>" . $arr['psgrade'] . "</td>";
                                            echo "<td>" . $arr['ksgrade'] . "</td>";
                                            echo "<td>" . $arr['grade'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <center>
                                    <button type="submit" class="btn btn-info">审核</button>&emsp;&emsp;
                                    <input type="button" name="submit" class="btn btn-info" onclick="javascript:history.back(-1);" value="返回">
                                </center>
                            </form>
                        </div>

                    </div>
                </div>
            </section>
            <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                    <p><a>© 2020 学生成绩管理系统.Wei.Zhong.Lin. Reserved.</a></p>
                </div>
            </div>
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/jquery.scrollTo.js"></script>

</body>
</html>
<?php
if ($_GET['action'] == "logout") {
    unset($_SESSION['admin_name']);
    echo "<script> alert('注销成功');</script>";
    echo "<script type='text/javascript'>" . "location.href='" . "login.html" . "'" . "</script>";
}
?>
<?php
if ($_GET['action'] == "submit") {
    $course_id = $_POST['course_id'];
    $sql = "update grade set flag='2' where course_id='$course_id'";
    $result = mysqli_query($conn,$sql);
    if ($result) {
        echo "<script> alert('审核成功，请打印!');</script>";
        echo "<script type='text/javascript'>" . "location.href='admin_yshcj.php'" . "</script>";
    } else {
        echo "<script> alert('审核失败！');</script>";
        echo "<script> history.go(-1);</script>";
    }
}
?>
