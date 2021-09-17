<?php
header("Content-Type: text/html;charset=utf-8");
session_start();
if ( !isset( $_SESSION[ 'admin_name' ] ) ) {
	header( "Location:login.html" );
	exit( '非法访问！' );
}
error_reporting( E_ERROR );
require_once( 'mysql_connect.php' );
?>
<!DOCTYPE html>
<head>
	<title>管理员界面</title>
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
				<a href="index_admin.php" class="logo">
                    管理员
                </a>
			

				<div class="sidebar-toggle-box">
					<div class="fa fa-bars"></div>
				</div>
			</div>
			<div class="nav notify-row" id="top_menu">
				<!--  notification start -->
				<ul class="nav top-menu">
					<!-- settings start -->
					<?php

					$sql = "select course_id,flag from grade where flag='1' group by course_id";

					$num = mysqli_num_rows( mysqli_query( $conn, $sql ) );
					?>
					<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-success"><?php echo $num; ?></span>
                        </a>
					

						<ul class="dropdown-menu extended tasks-bar">
							<li>
								<?php
								if ( $num ) {
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
				<ul class="nav pull-right top-menu">
					
					<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="images/2.png">
                            <span class="username">Admin</span>
                            <b class="caret"></b>
                        </a>
					

						<ul class="dropdown-menu extended logout">
							<li><a href="admin_xgmm.php"><i class="fa fa-cog"></i> 修改密码</a>
							</li>
							<li><a href="index_admin.php?action=logout"><i class="fa fa-key"></i> 注销</a>
							</li>
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
								<li><a href="admin_addy.php">单个添加</a>
								</li>
								<li><a href="admin_addd.php">批量添加</a>
								</li>
							</ul>
						</li>
						<li class="sub-menu">
							<a href="javascript:;">
                                <i class="fa fa-user"></i>
                                <span>添加老师</span>
                            </a>
						

							<ul class="sub">
								<li><a href="admin_addly.php">单个添加</a>
								</li>
								<li><a href="admin_addld.php">批量添加</a>
								</li>
							</ul>
						</li>
						<li class="sub-menu">
							<a href="javascript:;">
                                <i class="fa fa-envelope"></i>
                                <span>添加课程</span>
                            </a>
						

							<ul class="sub">
								<li><a href="admin_addcy.php">单个添加</a>
								</li>
								<li><a href="admin_addcd.php">批量添加</a>
								</li>
							</ul>
						</li>
						<li class="sub-menu">
							<a href="javascript:;">
                                <i class=" fa fa-bar-chart-o"></i>
                                <span>审核成绩</span>
                            </a>
						

							<ul class="sub">
								<li><a href="admin_wshcj.php">未审核信息</a>
								</li>
								<li><a href="admin_yshcj.php">已审核信息</a>
								</li>
							</ul>
						</li>
						<li class="sub-menu">
							<a href="javascript:;">
                                <i class=" fa fa-bar-chart-o"></i>
                                <span>查询成绩及统计</span>
                            </a>
						

							<ul class="sub">
								<li><a href="admin_cxcjkh.php">按课号查询</a>
								</li>
								<li><a href="admin_cxcjxh.php">按学号查询</a>
								</li>
							</ul>
						</li>
						<li class="sub-menu">
							<a href="javascript:;">
                                <i class="fa fa-glass"></i>
                                <span>查询信息</span>
                            </a>
						

							<ul class="sub">
								<li><a href="admin_selstu.php">查询学生信息</a>
								</li>
								<li><a href="admin_seltea.php">查询老师信息</a>
								</li>
								<li><a href="admin_selcou.php">查询课程信息</a>
								</li>
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
							课号
							<?php echo $_GET['flag'] ?>的学生成绩
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
										<th data-breakpoints="xs">学号</th>
										<th>姓名</th>
										<th>专业</th>
										<th>成绩</th>
										<th>排名</th>
									</tr>
								</thead>
								<tbody>
									<?php
									error_reporting( E_ERROR );
									$a = $_GET[ 'flag' ]; //course_id
							
$sql_pm = "select * from grade,student where grade.stuno=student.stuno and course_id='$a' order by grade desc";
									$r = mysqli_query( $conn, $sql_pm );
									$yx = 0;
									$lh = 0;
									$z = 0;
									$jg = 0;
									$bjg = 0;
									while ( $result = mysqli_fetch_array( $r ) ) {
										echo "<tr data-expanded='true'>";
										if ( $result[ 'grade' ] >= 90 )
											$yx++;
										else if ( $result[ 'grade' ] >= 80 )
											$lh++;
										else if ( $result[ 'grade' ] >= 70 )
											$z++;
										else if ( $result[ 'grade' ] >= 60 )
											$jg++;
										else
											$bjg++;
										echo "<td>" . $result[ 'stuno' ] . "</td>";
										echo "<td>" . $result[ 'name' ] . "</td>";
										echo "<td>" . $result[ 'ps' ] . "</td>";
										echo "<td>" . $result[ 'grade' ] . "</td>";
						$cjpm="select * from grade where grade>".$result['grade']." and course_id='$a'";
						$q_pm=mysqli_query($conn,$cjpm);
						$rank_ = mysqli_num_rows($q_pm); 
					 	$rank=$rank_+1;//在该课程成绩上的排名
										echo "<td>" . $rank. "</td>";
										echo "</tr>";
									}
									echo "<tr><td>成绩分布</td></tr>";
									echo "<tr><td>优(90-100)</td><td>良(80-90)</td><td>中(70-80)</td><td>及格(60-70)</td><td>不及格(60以下)</td></tr>";
									echo "<tr><td>" . $yx . "</td><td>" . $lh . "</td><td>" . $z . "</td><td>" . $jg . "</td><td>" . $bjg . "</td></tr>";
									?>
								</tbody>
							</table>
							<a href="admin_cxcjdc.php?flag=<?php echo $_GET['flag']; ?>" style="float:right;font-size:16px">打印成绩</a>
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