<?php 
 // print_r($_POST);
 $title = $_POST['title'];
 $author = $_POST['author'];
 $time = $_POST['time'];
 $content = $_POST['content'];
 $text = $_POST['text'];
 // 连接数据库
 $mysql = mysqli_connect('localhost','root','','blog');
 // 设置编码
 mysqli_query($mysql,'set names utf8');
 // 判断是更新还是添加
 if(isset($_GET['updata']) && $_GET['updata'] == 1){
 	$id = $_GET['id'];
 	// 更新语句
 	$sql = "UPDATE `blog-text` SET `title`='$title',`author`='$author',`content`='$content',`time`='$time',`text`='$text' WHERE `id`='$id' ";
 }else{
 	 // sql语句
    $sql = "INSERT INTO `blog-text` (`title`,`author`,`time`,`content`,`text`) VALUES ('$title','$author','$time','$content','$text') ";
 }

 // 执行mysqli语句
 $m = mysqli_query($mysql,$sql);
 $line = mysqli_affected_rows($mysql);
 if($line>0){
 	echo "发布成功";
 }else{
 	echo "发布失败";
 }