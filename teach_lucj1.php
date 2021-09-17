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
                <a href="index_teacher.php" class="logo">
                    教师
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
                <div class="table-agile-info">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            录入课号为<?php echo $_GET['flag'] ?>的学生成绩
                        </div>
                        <div>
                            <form action="teach_lucj1.php?action=lr&&flag=<?php echo $_GET['flag']; ?>" method="post">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $a=$_GET['flag'];
                                    
                                    $sql = "select * from grade,student where student.stuno=grade.stuno and grade.course_id='$a'";
                                    $res = mysqli_query( $conn,$sql);
                                    while ($arr = mysqli_fetch_array($res)) {
                                        echo "<tr data-expanded='true'>";
                                        echo "<td><input type='text' name='stuno[]' style='border:0px;' value='".$arr['stuno']."' readonly='readonly'  /></td>";
                                        echo "<td>" . $arr['name'] . "</td>";
                                        echo "<td>" . $arr['ps'] . "</td>";
                                        echo "<td><input type='text'  name='psgrade[]' value='".$arr['psgrade']."' /></td>";
                                        echo "<td><input type='text' name='ksgrade[]' value='".$arr['ksgrade']."' /></td>";
                                       
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                                <center>
                                <button type="submit" class="btn btn-info">保存</button>&emsp;&emsp;
                                <button type="reset" class="btn btn-info">重置</button>
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
    unset($_SESSION['teacher_name']);
    unset($_SESSION['teacher_id']);
    echo "<script> alert('注销成功');</script>";
    echo "<script type='text/javascript'>" . "location.href='" . "login.html" . "'" . "</script>";
}
if($_GET['action']=="lr"){
    $a = $_GET['flag'];
    $bb = array(
        $_POST['stuno'],
        $_POST['psgrade'],
        $_POST['ksgrade']
    );
    $cout1 = count($bb[0]); //列数
    $cout2 = count($bb); //行数
	
    for ($i = 0; $i < $cout1; $i++) {
        $array = array();
        for ($j = 0; $j < $cout2; $j++) {
            $array[] = $bb[$j][$i];
        }
        $sql="select blps,blks from course where course_id='$a'";
         $bl=mysqli_fetch_array(mysqli_query($conn,$sql));
        $sum1= $array[1] * $bl['blps'] + $array[2] * $bl['blks'];//成绩按平时和期末比例计算录入
        $sum= round($sum1);
        $sql = "update grade set psgrade='$array[1]',ksgrade='$array[2]',grade='$sum',flag='0' where course_id='$a' and stuno='$array[0]'";
        $res = mysqli_query( $conn, $sql);
    }
    if($res){
            echo "<script> alert('保存成功');</script>";
           echo "<script type='text/javascript'>"."location.href='"."teach_showcj.php?flag=".$a."'"."</script>";
        }
        else{
            echo "<script> alert('保存失败');</script>";
            echo "<script> history.go(-1);</script>";
    }
}
?>
