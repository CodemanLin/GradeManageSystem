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
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
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
        
        <div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            修改学生信息
                        </header>
                        <?php
                            error_reporting(E_ERROR);
                            $a=$_GET['flag']; 
                            $conn=@mysqli_connect("localhost","root","CZH123456");
                            mysqli_select_db($conn,"stugrade");
                            $sql="select * from student where stuno='$a'";
                            mysqli_query($conn,"set names 'utf8'");
                            $res=mysqli_query($conn,$sql);
                            $arr=mysqli_fetch_array($res);
                        ?>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="admin_upstu.php?action=update" method="post">
                                <div class="form-group">
                                    <label for="exampleInputText1">学号</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="stuno" value="<?php echo $arr['stuno']; ?>" required="required" readonly="readonly">
                                </div>
                                    <div class="form-group">
                                    <label for="exampleInputText1">姓名</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?php echo $arr['name']; ?>"> 
                                </div>
                                    <div class="form-group">
                                    <label>性别</label>&emsp;&emsp;&emsp;&emsp;
                                    <span><input type="radio"  name="sex" value="男" <?php if($arr['sex']=="男"){echo 'checked';}  ?> />男&emsp;&emsp;
                                        <input type="radio" name="sex"  value="女" <?php if($arr['sex']=="女"){echo 'checked';}  ?>      />女</span>
                                </div>
                                    <div class="form-group">
                                    <label for="exampleInputText1">系别</label>&emsp;&emsp;&emsp;&emsp;
                                    <select name="sdept">
                                        <option value="信息学院" <?php if($arr['sdept']=="信息学院"){echo 'selected';}  ?> >信息学院</option>
                                        <option value="会计学院" <?php if($arr['sdept']=="会计学院"){echo 'selected';}  ?> >会计学院</option>
                                        <option value="金融学院" <?php if($arr['sdept']=="金融学院"){echo 'selected';}  ?>> 金融学院</option>
                                        <option value="艺术学院"> 艺术学院</option>
                                        <option value=" 英文学院">英文学院</option>
                                        <option value="商学院">商学院</option>
                                        <option value="法学院">法学院</option>
                                        <option value="数学学院">数学学院</option>
                                    </select>
                                </div>
                                    <div class="form-group">
                                    <label for="exampleInputText1">入学时间</label>
                                    <input type="date" class="form-control" id="exampleInputEmail1" name="rxtime"  value="<?php echo $arr['rxtime']; ?>"  required="required">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputText1">籍贯</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"  value="<?php echo $arr['home']; ?>" name="home">
                                </div>
                                     <div class="form-group">
                                    <label for="exampleInputText1">专业</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="ps" value="<?php echo $arr['ps']; ?>">
                                </div>
                                     <div class="form-group">
                                    <label for="exampleInputText1">密码 </label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="password" value="<?php echo $arr['password']; ?>">
                                </div>
                                <button type="submit" class="btn btn-info">修改学生</button>&emsp;&emsp;
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
              <p><a>© 2020 学生成绩管理系统.Wei.Zhong.Lin. Reserved</a></p>
            </div>
          </div>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/jquery.scrollTo.js"></script>
</body>
</html>
<?php
    error_reporting(E_ERROR);
    if($_GET['action']=="update"){
        $stuno=$_POST['stuno'];
        $name=$_POST['name'];
        $sex=$_POST['sex'];
        $sdept=$_POST['sdept'];
        $home=$_POST['home'];
        $rxtime=$_POST['rxtime'];
        $ps=$_POST['ps'];
        $password=$_POST['password'];
        $conn=mysqli_connect("localhost","root","CZH123456")or die("数据库连接失败");
        $db= mysqli_select_db($conn,"stugrade");
        $sql="update student set name='$name',sex='$sex',sdept='$sdept',home='$home',rxtime='$rxtime',ps='$ps',password='$password' where stuno='$stuno'";
        mysqli_query($conn,"set names 'utf8'");
        $res=mysqli_query($conn,$sql);
        if($res){
           echo "<script> alert('修改成功');</script>";
           echo "<script type='text/javascript'>"."location.href='"."admin_selstu.php"."'"."</script>";
        }
        else{
            echo "<script> alert('修改失败');</script>";
            echo "<script> history.go(-1);</script>";
        }
    }
?>



