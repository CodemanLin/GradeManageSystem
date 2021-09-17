<?php

function expExcel($arr, $name) {

    require_once 'PHPExcel.php';
    //实例化
    $objPHPExcel = new PHPExcel();
    /* 右键属性所显示的信息 */
    $objPHPExcel->getProperties()->setCreator("admin")       //作者
            ->setLastModifiedBy("admin")       //最后一次保存者
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
            ->setCellValue('E1', '排名')
            //设置第一行为红色字体
            ->getStyle('A1:E1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

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
                ->setCellValue('D' . $key, $v['grade'])
                ->setCellValue('E' . $key, $v['rank']);
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


header("Content-type:text/html;charset=utf-8");
error_reporting(E_ERROR);
$a = $_GET['flag'];

//excel表格名
$name = "课号" . $a . "成绩表(管理员)";

//链接数据库
require_once( 'mysql_connect.php' );
//先获取数据

$sql_pm = "select * from grade,student where grade.stuno=student.stuno and course_id='$a' order by grade desc";//该课程的所有学生
$res = mysqli_query($conn,$sql_pm);
$arr = array();
$arr1 = array();
$arr2 = array();
$yx = 0;
$lh = 0;
$z = 0;
$jg = 0;
$bjg = 0;
//把$res=>$arr,把结果内容转移到一个数组中
while ($row = mysqli_fetch_assoc($res)) {
    $arr['stuno'] = $row['stuno'];
    $arr['name'] = $row['name'];
    $arr['ps'] = $row['ps'];
    $arr['grade'] = $row['grade'];
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
	
	$cjpm="select * from grade where grade>".$row['grade']." and course_id='$a'";
	$q_pm=mysqli_query($conn,$cjpm);
	$rank_ = mysqli_num_rows($q_pm); 
	$rank=$rank_+1;//在该课程成绩上的排名
	$arr['rank']=$rank;
	$arr2[]=$arr;//将arr数组中每个元组存放到arr中
}
$arr1['stuno']="";
    $arr2[]=$arr1;
    
    $arr1['stuno']="成绩分布如下";
    $arr2[]=$arr1;
    
    $arr1['stuno']="优";
    $arr1['name']="良";
    $arr1['ps']="中";
    $arr1['grade']="及格";
    $arr1['rank']="不及格";
    $arr2[]=$arr1;
    
    $arr1['stuno']=$yx;
    $arr1['name']=$lh;
    $arr1['ps']=$z;
    $arr1['grade']=$jg;
    $arr1['rank']=$bjg;
    $arr2[]=$arr1;
//调用
expExcel($arr2, $name);
?>




