<?php
	/**
	  *为图片增加文字水印
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
	//1.设置字体路径
	$font = 'msyh.ttf';
	//2.设置水印内容
	$content = 'hello world';
	//3.设置字体颜色和透明度
	$col = imagecolorallocatealpha($image,255,0,0,50);
	//4.写入文字
	imagettftext($image,15,0,20,30,$col,$font,$content);
	
	/*输出图片*/
	//1.浏览器输出
	header('Content-type:'.$info['mime']);
	$func = "image{$type}";
	$func($image);
	//2.保存图片
	$func($image,'fontmark.'.$type);//保存并重新命名
	
	/*销毁内存中的图片*/
	imagedestroy($image);
	
	function println($data){
		echo '<pre>';print_r($data);echo '</pre>';
		die();
	}
?>