<?php 
if(isset($_COOKIE['use']) && isset($_COOKIE['username'])){
	// 判断cookie是否正确
   $username = $_COOKIE['username'];
   $use = $_COOKIE['use'];
   // 连接数据库
   $mysql = mysqli_connect('localhost','root','','blog');
   // 设置编码格式
   mysqli_query($mysql,'set names utf8');
   // sql语句
   $sql = "SELECT * FROM `blog-admin` WHERE `username`='$username'";
   // 执行mysql语句
   $m = mysqli_query($mysql,$sql);
   // 转换为数组
   $arr = mysqli_fetch_assoc($m);
   if(!empty($arr))
   {
   	 $str = md5($arr['username'].$arr['password'].'weitong').':'.$arr['id'];
   	 if($str == $use){
   	 	$iscookie = $arr['username'];
   	 	echo $iscookie;
   	 }
   	 else{
   	 	$iscookie = false;
   	 	echo $iscookie;
   	 }
   }else{
   	$iscookie = false;
   	echo $iscookie;
   }
}else{
	$iscookie = false;
   	echo $iscookie;
}