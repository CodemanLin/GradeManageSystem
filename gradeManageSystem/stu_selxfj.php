<?php
header("Content-Type: text/html;charset=utf-8");
session_start();
if ((!isset($_SESSION['stu_name'])) || (!isset($_SESSION['stu_id']))) {
    header("Location:login.html");
    exit;
}
error_reporting(E_ERROR);
mysqli_query($conn, "set names 'utf8'");
?>
<!DOCTYPE html>
<head>
    <title>学生成绩管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/></script>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/style.css" rel='stylesheet' type='text/css'>
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
            <a href="index_stu.php" class="logo">
                学生
            </a>
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars"></div>
            </div>
        </div>
        <!--logo end-->
        <div class="nav notify-row" id="top_menu">

        </div>
        <div class="top-nav clearfix">
            <ul class="nav pull-right top-menu">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img alt="" src="images/2.png">
                        <span class="username"><?php echo $_SESSION['stu_name']; ?></span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <li><a href="stu_xgmm.php"><i class="fa fa-cog"></i> 修改密码</a></li>
                        <li><a href="index_stu.php?action=logout"><i class="fa fa-key"></i> 注销</a></li>
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
                        <a class="active" href="index_stu.php">
                            <i class="fa fa-dashboard"></i>
                            <span>首页</span>
                        </a>
                    </li>


                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-th"></i>
                            <span>基本信息</span>
                        </a>
                        <ul class="sub">
                            <li><a href="stu_selstu.php">查看基本信息</a></li>
                            <li><a href="stu_upstu.php">修改基本信息</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-tasks"></i>
                            <span>选课信息</span>
                        </a>
                        <ul class="sub">
                            <li><a href="stu_startxk.php">开始选课</a></li>
                            <li><a href="stu_yxkc.php">已选课程/退课</a></li>

                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-envelope"></i>
                            <span>成绩查询</span>
                        </a>
                        <ul class="sub">
                            <li><a href="stu_selcj.php">成绩查询</a></li>
                            <li><a href="stu_selxfj.php">学分绩查询</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-glass"></i>
                            <span>统计信息</span>
                        </a>
                        <ul class="sub">
                            <li><a href="stu_yqdxf.php">已取得学分</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
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
                        当前学分绩
                    </div>
                    <div>
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
                                <th data-breakpoints="xs">及格科目</th>
                                <th>不及格科目</th>
                                <th>学分成绩</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            error_reporting(E_ERROR);
                            $A = $_SESSION['stu_id'];
                            $conn = @mysqli_connect("localhost", "root", "");
                            mysqli_select_db($conn, "stugrade");
                            mysqli_query($conn, "set names 'utf8'");
                            echo "<tr data-expanded='true'>";

                            $sql = "select * from grade where stuno='$A' and flag='2' and grade >='60'";
                            $res = mysqli_num_rows(mysqli_query($conn, $sql));
                            echo "<td>" . $res . "</td>";
                            $sql = "select * from grade where stuno='$A' and flag='2' and grade < '60'";
                            $res = mysqli_num_rows(mysqli_query($conn, $sql));
                            echo "<td>" . $res . "</td>";
                            //计算每门课程学分成绩，总=每门学分*每门成绩
                            $sql = "select course.credit,grade.grade,(course.credit*grade.grade) as sum from course,grade where course.course_id=grade.course_id and flag='2' and stuno='$A'";
                            $res1 = mysqli_query($conn, $sql);
                            $count = 0;
                            $sum = 0;
                            while ($array = mysqli_fetch_array($res1)) {
                                $count += $array['credit'];
                                $sum += $array['sum'];
                            }
                            if ($count != '0') {
                                $xfj = $sum / $count;//平均学分成绩=总/总学分
                                $xfj1 = round($xfj, 2);  //采用四舍五入
                                echo "<td>" . $xfj1 . "</td>";
                            } else {
                                echo "<td>无</td>";
                            }
                            echo "</tr>";
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </section>
        <!--main content end-->
        <!-- footer -->
        <div class="footer">
            <div class="wthree-copyright">
                <p><a>© 2020 学生成绩管理系统.Wei.Zhong.Lin. Reserved.</a></p>
            </div>
        </div>
    </section>
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
    unset($_SESSION['stu_name']);
    unset($_SESSION['stu_id']);
    echo "<script> alert('注销成功');</script>";
    echo "<script type='text/javascript'>" . "location.href='" . "login.html" . "'" . "</script>";
}
?>

