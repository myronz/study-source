<?php
	class imageUtil{
		/**
		 * 图片基本信息
		 */
		private $info;	//图片信息
		private $image;	//内存中创建的图片
		
		public function __construct($src){
			$info = getimagesize($src);
			$this->info = array(
				'width' => $info[0],
				'height' => $info[1],
				'type' => image_type_to_extension($info['2'],false),
				'mime' => $info['mime']
			);
			//在内存中创建图片
			$fun = "imagecreatefrom{$this->info['type']}";
			$this->image = $fun($src);
		}
		
		/**
		 *	操作图片（压缩）
		 */
		public function thumb_image($width,$height){
			//在内存中建立宽$width，高$height的真色彩图片
			$image_thumb = imagecreatetruecolor($width, $height);
			//将原图主复制到真色彩图片上，并按照一定比例压缩
			imagecopyresampled($image_thumb,$this->image,0,0,0,0,$width,$height,$this->info['width'],$this->info['width']);
			//销毁原始图片
			imagedestroy($this->image);
			$this->image = $image_thumb;
		}
		
		
		/**
		 *	操作图片（添加文字水印）
		 */
		public function font_mark($content,$font_url,$size,$color,$local,$angle){
			//设置字体颜色和透明度
			$col = imagecolorallocatealpha($this->image,$color[0],$color[1],$color[2],$color[3]);
			//写入文字
			imagettftext($this->image,$size,$angle,$local['x'],$local['y'],$col,$font_url,$content);
		}
		
		/**
		 *	操作图片（添加图片水印）
		 */
		public function image_mark($source,$local,$alpha){
			//获取水印图片信息
			$image_mark_info = getimagesize($source);
			//获取水印图片类型
			$image_mark_type = image_type_to_extension($image_mark_info[2], false);
			//创建图片
			$fun2 = "imagecreatefrom{$image_mark_type}";
			//把水印图片复制到内存中
			$mark = $fun2($source);
			//合同图片
			imagecopymerge($this->image,$mark,$local['x'],$local['y'],0,0,$image_mark_info[0],$image_mark_info[1],$alpha);
			//销毁水印图片
			imagedestroy($mark);
		}
		
		
		
		/**
		 * 在浏览器中输出图片
		 */
		public function show_image(){
			header('Content-type:'.$this->info['mime']);
			$func = "image{$this->info['type']}";
			$func($this->image);
		}
		
		/**
		 * 保存图片
		 */
		public function save_image($new_name){
			header('Content-type:'.$this->info['mime']);
			$func = "image{$this->info['type']}";
			$func($this->image, $new_name.'.'.$this->info['type']);
		}
		
		/**
		 * 销毁图片
		 */
		public function __destruct(){
			imagedestroy($this->image);
		}
		
		
	}
?>