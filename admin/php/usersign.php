<?php 

$username = $_POST['username'];
$password = $_POST['password'];

// 连接数据库
$mysql = mysqli_connect('localhost','root','','blog');
// 设置编码
mysqli_query($mysql,'set names utf8');
// sql查询语句
$sql = "SELECT * FROM `blog-admin` WHERE `username`= '$username' AND `password`= '$password'";
// 执行sql
$m = mysqli_query($mysql,$sql);
// 转换为数组
$arr = mysqli_fetch_assoc($m);
if(empty($arr)){
	echo 0;
}else{
	echo 1;
}
// 设置cookie
if(!empty($arr)){
	setcookie('username',$username,0,'/blog/');
	$str = md5($username.$password.'weitong').':'.$arr['id'];
	setcookie('use',$str,0,'/blog/');
}