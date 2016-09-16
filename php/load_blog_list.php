<?php 

	session_start();
	
	$ret = '';

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

	// echo "tag=".$_POST['tag'];

	// 从表中提取信息的sql语句
	if(isset($_POST['tag'])){
		$strsql="SELECT * FROM `blog` where tag='".$_POST['tag']."';";
	}else{
		$strsql="SELECT * FROM `blog`;";
	}

	// 执行sql查询
	$result=mysql_db_query($mysql_database, $strsql, $conn);

	// 获取查询结果
	$row=mysql_fetch_row($result);

	$row_array = array();
	$row_array[$row[0]] = $row;

	while ($row = mysql_fetch_row($result)) {
		$row_array[$row[0]] = $row;
	}

	foreach($row_array as $x=>$x_value){
		$ret = $ret.'<div><form action="../../php/load_blog.php" method="post">';
		$ret = $ret.'<input type="text" name="id" value="'.$x_value[0].'" style="display: none" />';
		$ret = $ret.'<input type="submit" name="title" value="'.$x_value[1].'"></input>';
		if(isset($_SESSION['login'])) {
			$ret = $ret.'</form><form action="../../blog_editor.html" method="post">';
			$ret = $ret.'<input type="text" name="id" value="'.$x_value[0].'" style="display: none" />';
			$ret = $ret.'<input type="submit" name="title" value="编辑"></input>';
		}
		$ret = $ret.'</form></div><hr/>';
	}

	echo $ret;

	// 释放资源
	mysql_free_result($result);

	// 关闭连接
	mysql_close($conn);

 ?>