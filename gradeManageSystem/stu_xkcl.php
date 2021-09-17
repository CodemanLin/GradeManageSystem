<?php
header("Content-Type: text/html;charset=utf-8");
session_start();
error_reporting(E_ERROR);
$stuno = $_SESSION['stu_id'];
$flag = 0;
require_once('mysql_connect.php');


foreach ($_POST['chk'] as $val) {//将学生选择的所有课程插入grade表
    $sql = "insert into grade(course_id,stuno,flag) values('$val','$stuno','$flag')";
    $res = mysqli_query($conn, $sql);
}
if ($res) {
    echo "<script> alert('选课成功');</script>";
    echo "<script type='text/javascript'>" . "location.href='" . "stu_startxk.php" . "'" . "</script>";
} else {
    echo "<script> alert('选课失败');</script>";
    echo "<script> history.go(-1);</script>";
}
?>