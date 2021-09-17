<?php
    header("Content-Type: text/html;charset=utf-8");
    session_start();
    error_reporting(E_ERROR); 
    $stuno=$_POST['stuno'];
    $name=$_POST['name'];
    $sex=$_POST['sex'];
    $sdept=$_POST['sdept'];
    $home=$_POST['home'];
    $rxtime=$_POST['rxtime'];
    $ps=$_POST['ps'];
    require_once('mysql_connect.php');
    $sql="insert into student values('$stuno','$name','$sdept','$sex','$home','$rxtime','$ps','123')";
    $result=mysqli_query($conn,$sql);   //插入语句返回的是true or  false
    if($result){
        echo "<script>alert('添加成功！');window.location.href='admin_selstu.php';</script>";
    }
 else {
        echo "<script> alert('添加失败!');</script>";
        echo "<script> history.go(-1);</script>"; 
}
    
