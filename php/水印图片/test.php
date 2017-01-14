<?php
	require "imageUtil.class.php";
	$src = 'origin.jpg';
	$source = 'mark.png';
	$content = 'hello world';
	$font_url = 'msyh.ttf';
	$size = '14';
	$color = array(
		0 => 255,
		1 => 0,
		2 => 0,
		3 => 10
	);
	$local = array(
		'x' => 20,
		'y' => 20
	);
	$alpha = 30;
	$angle = 0;
	$image = new imageUtil($src);
	$image->image_mark($source,$local,$alpha);
	$image->show_image();
	// $image->save_image('newimage');
?>