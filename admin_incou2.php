<?php
header("Content-type:text/html;charset=utf-8");
error_reporting(E_ERROR);
function upExecel(){
//链接数据库
	require_once('mysql_connect.php');
//判断是否选择了要上传的表格
if (empty($_POST['myfile'])) {
    echo "<script>alert(您未选择表格);history.go(-1);</script>";
}

//获取表格的大小，限制上传表格的大小5M
$file_size = $_FILES['myfile']['size'];
if ($file_size>5*1024*1024) {
echo "<script>alert('导入失败，导入的表格不能超过5M的大小');history.go(-1);</script>";
    exit();
}

//限制上传表格类型
$file_type = $_FILES['myfile']['type'];
//application/vnd.ms-excel  为xls文件类型
if ($file_type!='application/vnd.ms-excel') {
    echo "<script>alert('上传失败，只能上传excel2003的xls格式!');history.go(-1)</script>";
 exit();
}

//判断表格是否上传成功
if (is_uploaded_file($_FILES['myfile']['tmp_name'])) {
    require_once 'PHPExcel.php';
    require_once 'PHPExcel/IOFactory.php';
    require_once 'PHPExcel/Reader/Excel5.php';
    //以上三步加载phpExcel的类

    $objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format 
    //接收存在缓存中的excel表格
    $filename = $_FILES['myfile']['tmp_name'];
    $objPHPExcel = $objReader->load($filename); //$filename可以是上传的表格，或者是指定的表格
    $sheet = $objPHPExcel->getSheet(0); 
    $highestRow = $sheet->getHighestRow(); // 取得总行数 
    // $highestColumn = $sheet->getHighestColumn(); // 取得总列数
    
    //循环读取excel表格,读取一条,插入一条
    //j表示从哪一行开始读取  从第二行开始读取，因为第一行是标题不保存
    //$a表示列号
    for($j=2;$j<=$highestRow;$j++)  
    {
        $a = $objPHPExcel->getActiveSheet()->getCell("A".$j)->getValue();//获取A(课程号)列的值
        $b = $objPHPExcel->getActiveSheet()->getCell("B".$j)->getValue();//获取B(课程名)列的值
        $c = $objPHPExcel->getActiveSheet()->getCell("C".$j)->getValue();//获取C(学分)列的值
        $d = $objPHPExcel->getActiveSheet()->getCell("D".$j)->getValue();//获取D(教师号)列的值
        $e = $objPHPExcel->getActiveSheet()->getCell("E".$j)->getValue();//获取E(开课时间)列的值
        $f = $objPHPExcel->getActiveSheet()->getCell("F".$j)->getValue();//获取D(平时)列的值
        $g = $objPHPExcel->getActiveSheet()->getCell("G".$j)->getValue();//获取D(期末)列的值
        $sql = "insert into course values('$a','$b','$c','$d','$e','$f','$g')";
        $result = mysqli_query($conn,$sql);
    }
    if ($result) {
            echo "<script>alert('添加成功！');window.location.href='admin_selcou.php.php';</script>";
            
        }else{
            echo "<script>alert('添加失败！');window.location.href='./admin_addcd.php';</script>";
            exit();
        }
    }
}

//调用
upExecel();
?>

