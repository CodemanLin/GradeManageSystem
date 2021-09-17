<?php
    header("Content-Type: text/html;charset=utf-8");
    session_start();
    error_reporting(E_ERROR); 
    $teacher_id=$_POST['teach_id'];
    $name=$_POST['name'];
    $sex=$_POST['sex'];
    $sdept=$_POST['sdept'];
    $position=$_POST['position'];
    $academic=$_POST['adademic'];
	require_once('mysql_connect.php');
    $sql="insert into teacher values('$teacher_id','$name','$sex','$sdept','$position',' $academic','123')";

    $result=mysqli_query($conn,$sql);   //插入语句返回的是true or  false
    if($result){
        echo "<script>alert('添加成功！');window.location.href='admin_seltea.php';</script>";
    }
 else {
        echo "<script> alert('添加失败');</script>";
        echo "<script> history.go(-1);</script>"; 
}
    
