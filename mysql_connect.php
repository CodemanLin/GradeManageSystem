<?php
$conn = @mysqli_connect("localhost","root","");
$conn or die('数据库服务器连接失败！系统错误信息为：'.mysqli_connect_error());
mysqli_select_db($conn, "stugrade") 
or die('打开数据库失败！系统错误信息为：'.mysqli_error($conn));
mysqli_query($conn, "set names utf8");
?>