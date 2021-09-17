<?php
header("Content-Type: text/html;charset=utf-8");
session_start();
if ((!isset($_SESSION['teacher_name'])) || (!isset($_SESSION['teacher_id']))) {
    header("Location:login.html");
    exit;
}
error_reporting(E_ERROR);
require_once('mysql_connect.php');
?>
<!DOCTYPE html>
<head>
    <title>学生成绩管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/style.css" rel='stylesheet' type='text/css'/>
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
            <a href="index_teacher.php" class="logo">
                教师
            </a>
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars"></div>
            </div>
        </div>
        <div class="top-nav clearfix">
            <ul class="nav pull-right top-menu">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img alt="" src="images/2.png">
                        <span class="username"><?php echo $_SESSION['teacher_name']; ?></span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <li><a href="tea_xgmm.php"><i class="fa fa-cog"></i> 修改密码</a></li>
                        <li><a href="index_teacher.php?action=logout"><i class="fa fa-key"></i> 注销</a></li>
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
                        <a class="active" href="index_teacher.php">
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
                            <li><a href="teach_seltea.php">查看基本信息</a></li>
                            <li><a href="teach_uptea.php">修改基本信息</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-tasks"></i>
                            <span>我的课程</span>
                        </a>
                        <ul class="sub">
                            <li><a href="teach_jcou.php">已结课</a></li>
                            <li><a href="teach_wcou.php">未结课</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-envelope"></i>
                            <span>录入成绩</span>
                        </a>
                        <ul class="sub">
                            <li><a href="teach_inadd.php">在线录入</a></li>

                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class=" fa fa-bar-chart-o"></i>
                            <span>查询成绩</span>
                        </a>
                        <ul class="sub">
                            <li><a href="teach_selkh.php">按课号查询</a></li>
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

            <div class="form-w3layouts">
                <!-- page start-->
                <!-- page start-->
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                我的基本信息
                            </header>
                            <center>
                                <div class="panel-body">
                                    <div class="position-center">
                                        <?php
                                        $teach_id = $_SESSION['teacher_id'];
                                        $sql = "select * from teacher where teach_id='$teach_id'";
                                        $res = mysqli_query($conn, $sql);
                                        $arr = mysqli_fetch_array($res);
                                        ?>
                                        <div class="form-group">
                                            <label for="exampleInputText1">教师号:<?php echo $arr['teach_id']; ?></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputText1">姓名:<?php echo $arr['name']; ?></label>

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputText1">性别:<?php echo $arr['sex']; ?></label>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputText1">系别:<?php echo $arr['sdept']; ?></label>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputText1">职位:<?php echo $arr['position']; ?></label>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputText1">学历:<?php echo $arr['academic']; ?></label>

                                        </div>
                                    </div>
                                </div>
                            </center>
                    </div>
                </div>
            </div>
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




