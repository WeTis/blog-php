<?php 
// print_r($_POST);
// print_r($_FILES);
require_once "file.fun.php";
$existence = null;
// 连接数据库
$mysql = mysqli_connect('localhost','root','','blog');
// if($mysql){
// 	echo "数据库连接成功";
// }
mysqli_query($mysql,"set names utf8");
// 判断用户名是否已经被占用
if(isset($_GET['isuser']) && $_GET['isuser']==1){
	$username = $_POST['name'];
    $sql = "SELECT * FROM `blog-admin` WHERE `username` LIKE '$username'";
    $m = mysqli_query($mysql,$sql);
    $arr = mysqli_fetch_assoc($m);
    if(!empty($arr)){
        $existence = 1;
    	echo $existence;
    }
    else{
    	$existence = 0;
    	echo $existence;
    }
}
if(!isset($_GET['isuser']) && $existence != 1 && !isset($_POST['modify'])){
	$nickname = $_POST['username'];
	$username = $_POST['reallname'];
	$password = $_POST['password'];
	$tell = $_POST['tell'];
	$email = $_POST['email'];
    $file = getFile();
    $img;
    // 上传文件
    foreach ($file as $key => $value) {
		$img = uploadFile($value,'../common/img');
	}
	// 数据上传数据库
    $sqll = "INSERT INTO `blog-admin` (`nickname`,`username`,`password`,`img`,`tell`,`email`,`leve`) VALUES('$nickname','$username','$password','$img','$tell','$email','2')";
    mysqli_query($mysql,$sqll);
    // 注册是否成功
    echo mysqli_affected_rows($mysql);
}
// 判断是否更新
if(isset($_POST['modify']) && $_POST['modify']==1){
    
    $nickname = $_POST['username'];
    $username = $_POST['reallname'];
    $password = $_POST['password'];
    $tell = $_POST['tell'];
    $email = $_POST['email'];
    $id = $_POST['id'];
    $img;
    // 查询数据库
    $sql = "SELECT * FROM `blog-admin` WHERE `id` LIKE '$id'";
    $m = mysqli_query($mysql,$sql);
    $arr = mysqli_fetch_assoc($m);
    if(!empty($arr)){
      $img = $arr['img'];
      if(empty($password)){
        $password = $arr['password'];
      }
    }
    if(!empty($_FILES)){
         $file = getFile();
        // 上传文件
        foreach ($file as $key => $value) {
            $img = uploadFile($value,'../common/img');
        }
    }
    // 数据上传数据库
    $sqll = "UPDATE `blog-admin` SET `username`='$username',`nickname`='$nickname',`password`='$password',`tell`='$tell',`email`='$email',`img`='$img' WHERE `id`='$id'";
    mysqli_query($mysql,$sqll);
    // 注册是否成功
    echo mysqli_affected_rows($mysql);
}
