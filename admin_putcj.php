<?php
header("Content-Type: text/html;charset=utf-8");
require_once('mysql_connect.php');
function expExcel($arr,$name){
    
    require_once 'PHPExcel.php';
    //实例化
    $objPHPExcel = new PHPExcel();
    /*右键属性所显示的信息*/
     $objPHPExcel->getProperties()->setCreator("teacher")       //作者
                           ->setLastModifiedBy("teacher")       //最后一次保存者
                           ->setTitle("学生成绩")      //标题
                           ->setSubject("学生成绩导出")    //主题
                           ->setDescription("导出选课学生成绩")     //描述
                           ->setKeywords("excel")           //标记
                          ->setCategory("result file");     //类别


    //设置当前的表格 
    $objPHPExcel->setActiveSheetIndex(0);
    // 设置表格第一行显示内容
    $objPHPExcel->getActiveSheet()
        ->setCellValue('A1', '学号')
        ->setCellValue('B1', '姓名')
        ->setCellValue('C1', '专业')
        ->setCellValue('D1', '平时成绩')
        ->setCellValue('E1', '考试成绩')
        ->setCellValue('F1', '总成绩')
        //设置第一行为红色字体
        ->getStyle('A1:F1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

    $key = 1;
    /*以下就是对处理Excel里的数据，横着取数据*/
    foreach($arr as $v){

    //设置循环从第二行开始
    $key++;
     $objPHPExcel->getActiveSheet()

                 //Excel的第A列，name是你查出数组的键值字段，下面以此类推
                  ->setCellValue('A'.$key, $v['stuno'])    
                  ->setCellValue('B'.$key, $v['name'])
                  ->setCellValue('C'.$key, $v['ps'])
                  ->setCellValue('D'.$key, $v['psgrade'])
                  ->setCellValue('E'.$key, $v['ksgrade'])
                  ->setCellValue('F'.$key, $v['grade']);

    }
    //设置当前的表格 
    $objPHPExcel->setActiveSheetIndex(0);
    ob_end_clean();     //清除缓冲区,避免乱码
     header('Content-Type: application/vnd.ms-excel');  //文件类型
     header('Content-Disposition: attachment;filename="'.$name.'.xls"');    //文件名
     header('Cache-Control: max-age=0');
     header('Content-Type: text/html; charset=utf-8');  //编码
     $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');     //excel 2003
     $objWriter->save('php://output');  
     exit;

}


header("Content-type:text/html;charset=utf-8");//文件编码
$a=$_GET['flag'];
//excel表格名
$name = "课号".$a."的学生成绩表(管理员)";
    
//链接数据库

//先获取数据
$sql = "select * from grade,student where student.stuno=grade.stuno and grade.course_id='$a' and flag='2'";

$res = mysqli_query($conn,$sql);
if($res){
$arr = array();
//把$res=>$arr,把结果集内容转移到一个数组中
while ($row = mysqli_fetch_assoc($res)){
    $arr[] = $row;
}



//调用
expExcel($arr,$name);
}
 else {
    echo "<script> alert('还未审核,不能打印!');</script>";
    echo "<script> history.go(-1);</script>";    
}
?>





