<?php 
header('Content-Type:application/json; charset=utf-8');
   //连接数据库
   $mysql = mysqli_connect('localhost','root','','blog');
   mysqli_query($mysql,'set names utf8');
   

   if(isset($_GET['delect']) && $_GET['delect'] == 1){
   	 $id = $_POST['id'];
   	 $delectSql = "DELETE FROM `blog-admin` WHERE `id`='$id'";
   	 $d = mysqli_query($mysql,$delectSql);
   	 print_r(json_encode(mysqli_affected_rows($mysql)));
   }else{
   	// 查询管理员列表
	   $sql = "SELECT `username`,`nickname`,`id`,`tell`,`img`,`email` FROM `blog-admin` ";
	   $m = mysqli_query($mysql,$sql);
	   $arr = [];
	   $num = mysqli_num_rows($m);
	   for ($i=0; $i < $num ; $i++) { 
	      $arr[] = mysqli_fetch_assoc($m);
	   }
	   print_r(json_encode($arr));
   }