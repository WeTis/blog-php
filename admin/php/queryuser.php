<?php 


require_once('file.fun.php');
$id = $_POST['id'];
$mysql = mysqli_connect('localhost','root','','blog');
mysqli_query($mysql,'set names utf8');
$sql = "SELECT `username`,`nickname`,`id`,`tell`,`img`,`email` FROM `blog-admin` WHERE `id`='$id'";
$m = mysqli_query($mysql,$sql);
$arr = mysqli_fetch_assoc($m);

if(empty($arr)){
	// echo "查询失败";
}else{
	echo(json_encode($arr));
}
// 判断是否有权限修改
