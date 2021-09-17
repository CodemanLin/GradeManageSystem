<?php
header("Content-Type: text/html;charset=utf-8");
session_start();
error_reporting(E_ERROR); 
$name=$_POST['name'];
$password=$_POST['password'];
$user=$_POST['user'];
if(!isset($user)){
    echo "<script> alert('请选择用户类型');</script>";
    echo "<script> history.go(-1);</script>";
}
$conn=mysqli_connect("localhost","root","")or die('连接数据库失败');
$db=mysqli_select_db($conn,"stugrade");
$sql1="select * from admin where admin_id ='$name' and password='$password' ";
$sql2="select * from teacher where teach_id ='$name' and password='$password' ";
$sql3="select * from student where stuno ='$name' and password='$password' ";
mysqli_query($conn,"set names 'utf8'");
switch($user){
    case 1:$result=mysqli_query($conn,$sql1)or die('查询不到'); 
               $row = mysqli_fetch_array($result);
               $count=$row[0];
               if($count!=""){
                   $url="index_admin.php";
                   $_SESSION['admin_name']=$row['name'];
                   $_SESSION['admin_id']=$row['admin_id'];
                   echo "<script type='text/javascript'>"."location.href='".$url."'"."</script>";
               }
               else {
                    echo "<script> alert('账户或密码错误');</script>";
                    echo "<script> history.go(-1);</script>";
                }
                break;
    case 2:$result=mysqli_query($conn,$sql2);  
        $result=mysqli_query($conn,$sql2)or die('查询不到'); 
               $row = mysqli_fetch_array($result);
               $count=$row[0];
               if($count!=""){
                   $url="index_teacher.php";
                   $_SESSION['teacher_name']=$row['name'];
                   $_SESSION['teacher_id']=$row['teach_id'];
                   echo "<script type='text/javascript'>"."location.href='".$url."'"."</script>";
               }
               else {
                    echo "<script> alert('账户或密码错误');</script>";
                    echo "<script> history.go(-1);</script>";
                }
                break;
    case 3:$result=mysqli_query($conn,$sql3);  
        $result=mysqli_query($conn,$sql3)or die('查询不到'); 
               $row = mysqli_fetch_array($result);
               $count=$row[0];
               if($count!=""){
                   $url="index_stu.php";
                   $_SESSION['stu_name']=$row['name'];
                   $_SESSION['stu_id']=$row['stuno'];
                   echo "<script type='text/javascript'>"."location.href='".$url."'"."</script>";
               }
               else {
                    echo "<script> alert('账户或密码错误');</script>";
                    echo "<script> history.go(-1);</script>";
                }
                break;
    default :break;
}  
?>




