<?php
	/**
	  *压缩图片
	*/

	/*打开图片*/
	//1.路径
	$src = 'origin.jpg';
	//2.获取图片信息
	$info = getimagesize($src);
	//3.获取图片类型
	$type = image_type_to_extension($info[2],false);
	//4.在内存中创建图片
	$fun = "imagecreatefrom{$type}";
	//5.把图片复制到内存中
	$image = $fun($src);
	
	/*操作图片*/
	//1.在内存中建立宽300，高200的真色彩图片
	$image_thumb = imagecreatetruecolor(150,100);
	//2.将原图主复制到真色彩图片上，并按照一定比例压缩
	imagecopyresampled($image_thumb,$image,0,0,0,0,150,100,$info[0],$info[1]);
	//销毁原始图片
	imagedestroy($image);
	
	/*输出图片*/
	//1.浏览器输出
	header('Content-type:'.$info['mime']);
	$func = "image{$type}";
	$func($image_thumb);
	//2.保存图片
	$func($image_thumb,'thumb_image.'.$type);//保存并重新命名
	
	/*销毁内存中的图片*/
	imagedestroy($image_thumb);
	
	function println($data){
		echo '<pre>';print_r($data);echo '</pre>';
		die();
	}
?>