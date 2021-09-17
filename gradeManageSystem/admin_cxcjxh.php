<?php
header("Content-Type: text/html;charset=utf-8");
session_start();
if (!isset($_SESSION['admin_name'])) {
    header("Location:login.html");
    exit('非法访问！');
}
error_reporting(E_ERROR);
mysqli_query($conn,"set names 'utf8'");
?>
<!DOCTYPE html>
<head>
    <title>管理员界面</title>
    <meta charset="utf-8" />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/bootstrap.min.css" ><!--页面布局-->
    <link href="css/font-awesome.css" rel="stylesheet"><!--选项小图标-->
    <script src="js/jquery2.0.3.min.js"></script><!--左边点击下拉框--!---->

    <link rel="stylesheet" href="css/monthly.css">
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
                    require_once('mysql_connect.php');
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
                             按学号查看成绩
                        </div>
                        <div>
                            <form action="admin_cxcjxh.php" method="post">
                                <label>
                                    请输入学号查询<input type="text"   name="stu_id"   >
                                    <button type="submit" class="btn btn-info">查询</button>
                                </label>

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
                                        <th>查看成绩</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    error_reporting(E_ERROR);
                                    $stuid=$_POST['stu_id'];
                                    if(!$stuid){
                                        $sql = "select * from student where  stuno in (select stuno from grade where flag='2')";
                                    }
                                    else{
                                        $sql = "select * from student where  stuno='$stuid'";
                                    }
                                        mysqli_query($conn,"set names 'utf8'");
                                    $res = mysqli_query($conn,$sql);
                                    while ($arr = mysqli_fetch_assoc($res)) {
                                        echo "<tr data-expanded='true'>";
                                        echo "<td>" . $arr['stuno'] . "</td>";
                                        echo "<td>" . $arr['name'] . "</td>";
                                        echo "<td>" . $arr['ps'] . "</td>";
                                        echo "<td><a href='admin_ckcj2.php?flag=" .$arr['stuno'] . "'>查看</a></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                </div>

            </section>
            <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                    <p><a>© 2020 学生成绩管理系统.Wei.Zhong.Lin. Reserved</a></p>
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
