<?php
	//解决递归查找顶级id
	$arr = array(
	  // id => pid
	  1 => 0,
	  5 => 1,
	  13 => 5
	);

	$id = 13;
	while($arr[$id]) {
	  $id = $arr[$id];
	}
	echo $id; // 1
?>