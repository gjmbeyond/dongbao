<?php 
	
	$mysql_server_name='localhost:3306'; //数据库服务器名称
	$mysql_username='root'; // 连接数据库用户名
	$mysql_password='root'; // 连接数据库密码
	$mysql_database='test'; // 数据库的名字

	// 连接到数据库
	$conn=mysql_connect($mysql_server_name, $mysql_username, $mysql_password);
	if (!$conn)
	{
		die('连接MySQL数据库失败：' . mysql_error());
	}

	// 设置数据库查询时的编码
	mysql_query('set names utf8', $conn);

	//此函数可以去掉换行。
	function trimall($str)
	{
		$qian=array("\n","\r");
		$hou=array("","");
		return str_replace($qian,$hou,$str); 
	}

	date_default_timezone_set('Asia/Shanghai');

	$timeStr = date('Y-m-d H:i:s');

	// 从表中提取信息的sql语句
	$strsql="SELECT * FROM `blog` where title='".$_POST['title']."';";

	// 执行sql查询
	$result=mysql_db_query($mysql_database, $strsql, $conn) or die("查询博文是否已经存在失败");

	if(count($result) > 0 && ($_POST['id'] != null && $_POST['id'] != '')){
		$strsql = "UPDATE `test`.`blog` SET html='".htmlspecialchars(trimall($_POST['content']))."', tag='".htmlspecialchars($_POST['tag'])."' where id=".$_POST['id'].";";
	} else {
		$strsql = "INSERT INTO `test`.`blog` (`title`, `address`, `date`, `author`, `tag`, `html`, `like`) VALUES ('".$_POST['title']."', 'htmls/1.html', '".$timeStr."', '".htmlspecialchars($_POST['author'])."', '".htmlspecialchars($_POST['tag'])."', '".htmlspecialchars(trimall($_POST['content']))."', 0);";
	}

	echo $strsql;

	// 执行sql查询
	$result=mysql_db_query($mysql_database, $strsql, $conn) or die("插入数据失败");

	echo $result;

	// 释放资源
	mysql_free_result($result);

	// 关闭连接
	mysql_close($conn);
 ?>