<?php 
/** 
 * 获取上传文件信息，并重新排版组装成数组
 * This is a cool function
 * @Author   weitong
 * @DateTime 2018-05-17
 * @param    [type]  文件上传变量信息
 * @return   [type]
 */
 function getFile(){
 	 $i = 0;
	 foreach ($_FILES as  $value) {
		if(is_string($value['name'])){
	       $files[$i] = $value;
	       $i++;
	 	}elseif (is_array($value['name'])) {
	 		foreach ($value['name'] as $key=>$item) {
	 			$files[$i]['name'] = $value['name'][$key];
	 			$files[$i]['type'] = $value['type'][$key];
	 			$files[$i]['tmp_name'] = $value['tmp_name'][$key];
	 			$files[$i]['error'] = $value['error'][$key];
	 			$files[$i]['size'] = $value['size'][$key];
	 			$i++;
	 		}
	 	}
	 }
	
	 return $files;
 }
/**
 * This is a cool function
 * @Author   weitong
 * @DateTime 2018-05-17
 * @param    [type]
 * @param    boolean
 * @param    array
 * @param    integer
 * @param    string
 * @return   [type]
 */
  function uploadFile($fileinfo,$uploadPath='uploads',$flag=true,$filetypearry=array('png','jpg','gif','7z'),$maxSize = 1048576){
     $error='';
     $filename = $fileinfo["name"];
	 $tmpname = $fileinfo["tmp_name"];
	 $filetype = $fileinfo["type"];
	 $filesize = $fileinfo["size"];
	 $errorinfo = $fileinfo["error"];

  	// 判断文件上传时错误
  	if($errorinfo > 0){
	// 文件上传失败
		switch ($errorinfo) {
			case '1':
				$error= "上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值";
				break;
			case '2':
			    $error= "上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值";
			    break;
			case '3':
				$error= "文件只有部分被上传";
				break;
			case '4':
				$error= "没有文件被上传";
				break;
			case '6':
				$error= "找不到临时文件夹";
				break;
			case '7':
			    $error= "文件写入失败";
				break;
		}
	echo  $error;
	return false;
	}
  // 判断文件类型
	
	if(! in_array(strtolower(pathinfo($filename,PATHINFO_EXTENSION)),$filetypearry) ){
	    $error= "非法文件类型";
	    echo  $error;
	    return false;
	}
   // 判断文件大小是否符合
	
	if($filesize>$maxSize){
		$error=  "上传文件大小1M超过限制";
		echo  $error;
		return false;
	}
   // 判断临时文件是否是通过 HTTP POST 上传的
	if(!is_uploaded_file($tmpname))
	{
		$error="文件不是通过 HTTP POST 上传的";
		echo  $error;
		return false;
	}
  // 判断文件是否真实图片
	if($flag){
		if(@!getimagesize($tmpname)){
			$error='不是真实图片';
			echo $error;
			return false;
		}
	}
  //检查目录是否存在
	if(! file_exists($uploadPath)){
		// 如果不存在创建目录
		mkdir($uploadPath,0777,true);
	}
  // 防止文件重命名 产生唯一文件名
   $uniName=md5(uniqid(microtime(true),true)).'.'.pathinfo($filename,PATHINFO_EXTENSION);
   // 移动文件到指定目录
   $destination = $uploadPath.'/'.$uniName;
   if(@!move_uploaded_file($tmpname, $destination)){
   	echo "文件移动失败";

   }

   // 返回文件路径
   return $uniName;
  }