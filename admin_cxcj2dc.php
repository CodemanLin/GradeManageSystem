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
            ->setCellValue('A1', '课号')
            ->setCellValue('B1', '课程名')
            ->setCellValue('C1', '学分')
            ->setCellValue('D1', '学年')
            ->setCellValue('E1', '成绩')
            ->setCellValue('F1', '排名')
            //设置第一行为红色字体
            ->getStyle('A1:F1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

    $key = 1;
    /* 以下就是对处理Excel里的数据，横着取数据 */
    foreach ($arr as $v) {

        //设置循环从第二行开始
        $key++;
        $objPHPExcel->getActiveSheet()

                //Excel的第A列，name是你查出数组的键值字段，下面以此类推
                ->setCellValue('A' . $key, $v['course_id'])
                ->setCellValue('B' . $key, $v['course_name'])
                ->setCellValue('C' . $key, $v['credit'])
                ->setCellValue('D' . $key, $v['xktime'])
                ->setCellValue('E' . $key, $v['grade'])
                ->setCellValue('F' . $key, $v['rank']);
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
$name = "学号" . $a . "成绩表(管理员)";

//链接数据库
require_once( 'mysql_connect.php' );
//先获取数据


$sql_pm = "select * from grade,course where course.course_id=grade.course_id and flag='2' and  grade.stuno='$a'";//该学生的所有课程
$res = mysqli_query($conn,$sql_pm);

$arr = array();
$arr1 = array();
$arr2=array();
$yx = 0;
$lh = 0;
$z = 0;
$jg = 0;
$bjg = 0;

//把$res=>$arr,把结果集内容转移到一个数组中
while ($row = mysqli_fetch_assoc($res)) {
    $arr['course_id'] = $row['course_id'];
    $arr['course_name'] = $row['course_name'];
    $arr['credit'] = $row['credit'];
    $arr['xktime'] = $row['xktime'];
    //排名查询
	
	$sql_cj = "select * from grade where stuno='$a' and course_id='".$arr['course_id']."'";//每次处理该学生一门课程
     $r=mysqli_query($conn,$sql_cj);
             while($result=mysqli_fetch_array($r)){
                 if($result['stuno']==$a){
                     if($result['grade']>=90)
                            $yx++;
                     else if($result['grade']>=80)
                                    $lh++;
                           else if($result['grade']>=70)
                                            $z++;
                                 else if($result['grade']>=60)
                                                 $jg++;
                                       else
                                           $bjg++;
                    $arr['grade'] =$result['grade'];
			$sql_pm = "select * from grade where grade>".$result['grade']."and course_id='".$arr['course_id']."'";//找出该课程的学生成绩大于该学生的
			$q_pm=mysqli_query($conn,$sql_pm);
			$rank = mysqli_num_rows($q_pm); 
					 $rank_=$rank+1;//在该课程成绩上的排名
					$arr['rank'] = $rank_;
                 }
			
             }
    $arr1[] = $arr;    //采用数组追加数值放入结果数组
}


$arr2['course_id']="";
    $arr1[]=$arr2;
    
    $arr2['course_id']="成绩分布如下";
    $arr1[]=$arr2;
    
    $arr2['course_id']="优(90-100)";
    $arr2['course_name']="良(80-90)";
    $arr2['credit']="中(70-80)";
    $arr2['xktime']="及格(60-70)";
    $arr2['grade']="不及格(60以下)";
    $arr1[]=$arr2;
    
    $arr2['course_id']=$yx;
    $arr2['course_name']=$lh;
    $arr2['credit']=$z;
    $arr2['xktime']=$jg;
    $arr2['grade']=$bjg;
    $arr1[]=$arr2;
expExcel($arr1,$name);

?>





