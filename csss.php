<?php
    session_start();
    if((!isset($_SESSION['stu_name'])) || (!isset($_SESSION['stu_id']))){
        header("Location:login.html");
        exit;
    }
    error_reporting(E_ERROR); 
    mysqli_query($conn,"set names 'utf8'");
?>
<!DOCTYPE html>
<head>
<title>学生成绩管理系统</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel="stylesheet" href="css/bootstrap.min.css" >
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<link rel="stylesheet" href="css/monthly.css">
<script src="js/jquery2.0.3.min.js"></script>
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.html" class="logo">
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
    <ul class="nav pull-right top-menu" >
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <li class="dropdown" >
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="images/2.png">
                <span class="username"><?php echo $_SESSION['stu_name']; ?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class="fa fa-cog"></i> 修改密码</a></li>
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
                        <li><a href="stu_selcj.php">成绩查询及排名</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span>修改密码</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-glass"></i>
                        <span>查询信息</span>
                    </a>
                    <ul class="sub">
                        <li><a href="gallery.html">查询学生信息</a></li>
			<li><a href="404.html">查询老师信息</a></li>
                        <li><a href="registration.html">查询课程信息</a></li>
                    </ul>
                </li>
                <li>
                    <a href="login.html">
                        <i class="fa fa-user"></i>
                        <span>Login Page</span>
                    </a>
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
       查看成绩
    </div>
    <div>
        <form action='stu_yxkc.php?action=tk' method='post' >
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
            <th>总分</th>
            <th>排名</th>
          </tr>
        </thead>
        <tbody>
        <?php
             error_reporting(E_ERROR);
             $A=$_SESSION['stu_id'];
             
			require_once('mysql_connect.php');
             $sql="select course.*,teacher.* from course,teacher  where  course.teach_id=teacher.teach_id and course.course_id =any(select course_id from grade where stuno='$A' and flag='2')";

             $res=mysqli_query($conn,$sql);
             if(mysqli_num_rows($res)){
             while($arr=mysqli_fetch_assoc($res)){
             echo "<tr data-expanded='true'>";
             echo  "<td>".$arr['course_id']."</td>";
             echo  "<td>".$arr['course_name']."</td>";
             echo  "<td>".$arr['credit']."</td>";
             $course=$arr['course_id'];
             $sql1="alter view pm as select * from grade where course_id='$course'";
             mysqli_query($conn,$sql1);
            //排名查询
             $sql_pm="select sc_id,course_id,stuno,grade,rank from (select sc_id,course_id,stuno,grade,@curRank :=IF(@prevRank =grade,@curRank,@incRank) as rank,@incRank :=@incRank+1,@prevRank:=grade from pm p,(select @curRank :=0,@prevRank :=NULL,@incRank:=1) r order by grade desc)s";
             $r=mysqli_query($sql_pm,$conn);
             if($result=mysqli_fetch_array($r)){
                 if($result['stuno']==$A){
                     echo  "<td>".$result['grade']."</td>";
                     echo  "<td>".$result['rank']."</td>"; 
                 }
             }
             echo  "</tr>"; 
             }
             }
             else{
                    echo "<tr><td>您还没有结课科目！</td></tr>";
             }
        ?>
        </tbody>
      </table>
        </form>
    </div>
  </div>
</div>

</section>
<!--main content end-->
 <!-- footer -->
          <div class="footer">
            <div class="wthree-copyright">
              <p>© 2020 学生成绩管理系统.Design by Wei.Zhong.Lin.</a></p>
            </div>
          </div>
</section>
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="js/monthly.js"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		}

		});
	</script>
</body>
</html>
<?php
    if($_GET['action']=="logout"){
        unset($_SESSION['stu_name']);
        unset($_SESSION['stu_id']);
       echo "<script> alert('注销成功');</script>";
        echo "<script type='text/javascript'>"."location.href='"."login.html"."'"."</script>"; 
    }
?>
<?php
    if($_GET['action']=="tk"){
        error_reporting(E_ERROR);
        $stuno=$_SESSION['stu_id'];
        $conn=mysqli_connect("localhost","root","CZH123456");
        mysqli_select_db($conn,"stugrade");
        mysqli_query($conn,"set names 'utf8'");
        foreach ($_POST['chk'] as $val){
            $sql="delete from grade where stuno='$stuno' and course_id='$val'";
            $res=mysqli_query($conn,$sql);
        }
        if($res){
            echo "<script> alert('退课成功');</script>";
           echo "<script type='text/javascript'>"."location.href='"."stu_yxkc.php"."'"."</script>";
        }
        else{
            echo "<script> alert('退课失败');</script>";
            echo "<script> history.go(-1);</script>";
    }}
?>
