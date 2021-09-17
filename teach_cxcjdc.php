<?php

function expExcel($arr, $name) {

    require_once 'PHPExcel.php';
    //实例化
    $objPHPExcel = new PHPExcel();
    /* 右键属性所显示的信息 */
    $objPHPExcel->getProperties()->setCreator("teacher")       //作者
            ->setLastModifiedBy("teacher")       //最后一次保存者
            ->setTitle("成绩单")      //标题
            ->setSubject("成绩单导出")    //主题
            ->setDescription("导出成绩单")     //描述
            ->setKeywords("excle")           //标记
            ->setCategory("result excle");     //类别
    //设置当前的表格 
    $objPHPExcel->setActiveSheetIndex(0);
    // 设置表格第一行显示内容
    $objPHPExcel->getActiveSheet()
            ->setCellValue('A1', '学号')
            ->setCellValue('B1', '姓名')
            ->setCellValue('C1', '专业')
            ->setCellValue('D1', '成绩')
            //->setCellValue('E1', '排名')
            //设置第一行为红色字体
            ->getStyle('A1:D1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

    $key = 1;
    /* 以下就是对处理Excel里的数据，横着取数据 */
    foreach ($arr as $v) {

        //设置循环从第二行开始
        $key++;
        $objPHPExcel->getActiveSheet()

                //Excel的第A列，name是你查出数组的键值字段，下面以此类推
                ->setCellValue('A' . $key, $v['stuno'])
                ->setCellValue('B' . $key, $v['name'])
                ->setCellValue('C' . $key, $v['ps'])
                ->setCellValue('D' . $key, $v['grade']);
                //->setCellValue('E' . $key, $v['rank'])
    }
    //设置当前的表格 
    $objPHPExcel->setActiveSheetIndex(0);
    ob_end_clean();     //清除缓冲区,避免乱码
    header('Content-Type: application/vnd.ms-excel');  //文件类型
    header('Content-Disposition: attachment;filename="' . $name . '.xls"');    //文件名
    header('Cache-Control: max-age=0');
    header('Content-Type: text/html; charset=utf-8');  //编码
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');     //excel 2003
    $objWriter->save('php://output');
    exit;
}

/* * *********调用********************* */
header("Content-type:text/html;charset=utf-8");
error_reporting(E_ERROR);
$a = $_GET['flag'];

//excel表格名
$name = "课号" . $a . "成绩表(老师)";

//链接数据库
require_once('mysql_connect.php');

//先获取数据
//排名查询
$sql_pm = "select * from grade,student where student.stuno=grade.stuno and course_id='$a'";
$res = mysqli_query( $conn,$sql_pm);
$arr = array();
$arr1 = array();
$yx = 0;
$lh = 0;
$z = 0;
$jg = 0;
$bjg = 0;
//把$res=>$arr,把结果集内容转移到一个数组中
while ($row = mysqli_fetch_assoc($res)) {
    if ($row['grade'] >= 90)
        $yx++;
    else if ($row['grade'] >= 80)
        $lh++;
    else if ($row['grade'] >= 70)
        $z++;
    else if ($row['grade'] >= 60)
        $jg++;
    else
        $bjg++;
    $arr[] = $row;
}
    $arr1['stuno']="";
    $arr[]=$arr1;
    
    $arr1['stuno']="成绩分布如下";
    $arr[]=$arr1;
    
    $arr1['stuno']="优";
    $arr1['name']="良";
    $arr1['ps']="中";
    $arr1['grade']="及格";
    //$arr1['rank']="不及格";
    $arr[]=$arr1;
    
    $arr1['stuno']=$yx;
    $arr1['name']=$lh;
    $arr1['ps']=$z;
    $arr1['grade']=$jg;
    //$arr1['rank']=$bjg;
    $arr[]=$arr1;
   
//调用
expExcel($arr, $name);
?>




