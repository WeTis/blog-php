<?php 
// 判断是否删除
if(isset($_POST['delect']) && $_POST['delect'] == 1){
  // 获取文章id
  $id = $_POST['id'];
  $title = $_POST['title'];
  // 连接数据库
  $mysql = mysqli_connect('localhost','root','','blog');
  // 设置传输编码
  mysqli_query($mysql,'set names utf8');
  // 查询语句 id 是否存在 title
  $sql = "SELECT `id`,`title` FROM `blog-text` WHERE `id`='$id' AND `title` = '$title' ";
  // 执行sql语句
  $m = mysqli_query($mysql,$sql);
  $arr = mysqli_fetch_assoc($m);
  if(!empty($arr)){
    // 存在执行删除 
    $sqll = "DELETE FROM `blog-text` WHERE `id`='$id' AND `title`='$title'";
    mysqli_query($mysql,$sqll);
   echo mysqli_affected_rows($mysql);

  }else{
  	echo "删除失败";
  }
}