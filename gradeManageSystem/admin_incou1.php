<?php
    header("Content-Type: text/html;charset=utf-8");
    session_start();
    error_reporting(E_ERROR); 
	require_once('mysql_connect.php');
    $course_id=$_POST['course_id'];
    $name=$_POST['name'];
    $credit=$_POST['credit'];
    $xktime=$_POST['xktime'];
    $blps=$_POST['blps'];
    $blks=$_POST['blks'];
    $teach_id=$_POST['teach_id'];

    $sql="insert into course values('$course_id','$name','$credit','$teach_id','$xktime','$blps','$blks')";
    $result=mysqli_query($conn,$sql);   //插入语句返回的是true or  false
    if($result){
        echo "<script>alert('添加成功！');window.location.href='admin_selcou.php';</script>";
    }
 else {
        echo "<script> alert('添加失败');</script>";
        echo "<script> history.go(-1);</script>"; 
}
    
