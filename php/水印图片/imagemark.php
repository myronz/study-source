<?php
	/**
	  *为图片增加图片水印
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
	//1.设置水印路径
	$image_mark = 'mark.png';
	//2.获取水印图片信息
	$image_mark_info = getimagesize($image_mark);
	//3.获取水印图片类型
	$image_mark_type = image_type_to_extension($image_mark_info[2], false);
	//4.创建图片
	$fun2 = "imagecreatefrom{$image_mark_type}";
	//5.把水印图片复制到内存中
	$mark = $fun2($image_mark);
	//6.合同图片
	imagecopymerge($image,$mark,0,0,0,0,$image_mark_info[0],$image_mark_info[1],30);
	//7.销毁水印图片
	imagedestroy($mark);
	
	/*输出图片*/
	//1.浏览器输出
	header('Content-type:'.$info['mime']);
	$func = "image{$type}";
	$func($image);
	//2.保存图片
	$func($image,'imagemark.'.$type);//保存并重新命名
	
	/*销毁内存中的图片*/
	imagedestroy($image);
	
	function println($data){
		echo '<pre>';print_r($data);echo '</pre>';
		die();
	}
?>