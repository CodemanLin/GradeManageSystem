<?php
header("Content-Type: text/html;charset=utf-8");
session_start();
if ((!isset($_SESSION['stu_name'])) || (!isset($_SESSION['stu_id']))) {
    header("Location:login.html");
    exit;
}
error_reporting(E_ERROR);
?>
<!DOCTYPE html>
<head>
    <title>学生成绩管理系统</title>
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
                <a href="index_stu.php" class="logo">
                    学生
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <div class="top-nav clearfix">
                <ul class="nav pull-right top-menu" >
                    <li class="dropdown" >
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
            </ul>            </div>
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
                                    修改密码 
                                </header>
                                <div class="panel-body">
                                    <div class="position-center">
                                        <form role="form" action="stu_xgmm.php?action=update" method="post">
                                            <div class="form-group">
                                                <label for="exampleInputText1">学号</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" name="stu_id" value="<?php echo $_SESSION['stu_id'] ?>" readonly="readonly">
                                            </div>
                                            <div class="form-group" >
                                                <label for="exampleInputText1">原密码</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1"  name="ypsw" >
                                            </div>
                                            <div class="form-group" >
                                                <label for="exampleInputText1">新密码</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1"  name="xpsw1">
                                            </div>
                                            <div class="form-group" >
                                                <label for="exampleInputText1">再次输入新密码</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1"  name="xpsw2" >
                                            </div>
                                            <button type="submit" class="btn btn-info">修改</button>
                                            <button type="reset" class="btn btn-info">重置</button>
                                        </form>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
            </section>
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
<?php
error_reporting(E_ERROR);
if ($_GET['action'] == "update") {
    $stu_id = $_POST['stu_id'];
    $psw = $_POST['ypsw'];
    $psw1 = $_POST['xpsw1'];
    $psw2 = $_POST['xpsw2'];
    $sql = "select password from student where stuno='$stu_id'";
    $res = mysqli_query($conn,$sql);
    $arr = mysqli_fetch_array($res);
//    echo $arr;
    if ($arr['password'] != $_POST['ypsw']) {
        echo "<script> alert($sql);</script>";//'原密码不正确!'
        echo "<script> history.go(-1);</script>";
    } else {
        if ($psw1 != $psw2) {
            echo "<script> alert('新密码确认不正确!');</script>";
            echo "<script> history.go(-1);</script>";
        } else {
            $sql = "update student set password='$psw1' where stuno='$stu_id'";
            mysqli_query($conn,"set names 'utf8'");
            $res = mysqli_query($conn,$sql);
            if ($res) {
                echo "<script> alert('修改成功');</script>";
                echo "<script type='text/javascript'>" . "location.href='" . "index_stu.php" . "'" . "</script>";
            } else {
                echo "<script> alert('修改失败');</script>";
                echo "<script> history.go(-1);</script>";
            }
        }
    }
}
?>





