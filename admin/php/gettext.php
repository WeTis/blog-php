<?php 
header('Content-Type:application/json; charset=utf-8');
// 连接数据库
$mysql = mysqli_connect('localhost','root','','blog');
// 设置字符串
mysqli_query($mysql,'set names utf8');
if(isset($_POST['id'])){
	$id = $_POST['id'];
	$m = "SELECT * FROM `blog-text` WHERE `id`='$id'";
}else{
	// sql语句
   $m = 'SELECT * FROM `blog-text` ORDER BY `id`';
}
// 执行sql语句
 $sql = mysqli_query($mysql,$m);

// 转换为字符串判断是否获取成功
 if(isset($_POST['id']))
{ 
	$arr = mysqli_fetch_assoc($sql);
	if(empty($arr)){
        print_r(json_encode('获取失败'));
	}else{
		print_r(json_encode($arr));
	}
  

}else{
	// 获取结果长度
    $num = mysqli_num_rows($sql);

	if($num>0)
	{ 
	  $arr = [];
	  for ($i=0; $i < $num ; $i++) { 
	  	$arr[]= mysqli_fetch_assoc($sql);
	  }
	  print_r(json_encode($arr));
	  
	}else{
	  print_r(json_encode('获取失败'));
	}
  
}
