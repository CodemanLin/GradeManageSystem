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
					require_once( 'mysql_connect.php' );
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
       查询课程基本信息
    </div>
    <div>
        <form action="admin_selcou.php" method="post">
            <select name="coutj">
                <option selected value="">请选择查询条件</option>
                <option value="course_id">课号</option>
                <option value="course_name">课程名</option>
                <option value="xktime">开课时间</option>
            </select>
              <input type="text"   name="val" >
              <button type="submit" class="btn btn-info">查询</button>
                              
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
            <th data-breakpoints="xs">课程号</th>
            <th>课程名</th>
            <th>学分</th>
            <th>教师号</th>
            <th>教师</th>
            <th>开课时间</th>
            <th>平时成绩</th>
            <th>期末成绩</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
        <?php
             error_reporting(E_ERROR);
             $coutj=$_POST['coutj'];
             $val=$_POST['val'];
             if(!$val){
             $sql="select course.*,teacher.* from course,teacher  where  course.teach_id=teacher.teach_id";
             }
             else{ 
                 $sql="select course.*,teacher.* from course,teacher where course.teach_id=teacher.teach_id and $coutj='$val'";
             }
             $res=mysqli_query($conn,$sql);
             //print_r(mysql_fetch_assoc($res));
             //exit();
             while($arr=mysqli_fetch_assoc($res)){
             echo "<tr data-expanded='true'>";
             echo  "<td>".$arr['course_id']."</td>";
             echo  "<td>".$arr['course_name']."</td>";
             echo  "<td>".$arr['credit']."</td>";
             echo  "<td>".$arr['teach_id']."</td>";
             echo  "<td>".$arr['name']."</td>";
             echo  "<td>".$arr['xktime']."</td>";
             echo  "<td>".$arr['blps']."</td>";
             echo  "<td>".$arr['blks']."</td>";
             $a=$arr['course_id']-100789;                //隐藏stuno
             echo  "<td><a href='admin_upcou.php?flag=".$arr['course_id']."'>修改</a>/<a href='admin_selcou.php?action=del&&t%o0%m=".$a."'>删除</a></td>";
             echo  "</tr>"; 
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
    header("Content-Type: text/html;charset=utf-8");
    error_reporting(E_ERROR);
    if($_GET['action']=="del"){
        $course_id=$_GET['t%o0%m']+100789;    //为了隐藏数据库字段，用其他符号代替stuno
        $sql="delete from course where course_id='$course_id'";
        $res=mysqli_query($conn,$sql);
        if($res){
           echo "<script> alert('删除成功');</script>";
           echo "<script type='text/javascript'>"."location.href='"."admin_selcou.php"."'"."</script>";
        }
        else{
            echo "<script> alert('删除失败');</script>";
            echo "<script type='text/javascript'>"."location.href='"."admin_selcou.php"."'"."</script>";
        }
    }
?>



