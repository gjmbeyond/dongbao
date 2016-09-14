<?php 
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

	// 从表中提取信息的sql语句
	$strsql="SELECT * FROM `blog` where id=".$_POST['id'].";";

	// 执行sql查询
	$result=mysql_db_query($mysql_database, $strsql, $conn) or die("查询获取数据失败");

	// 获取查询结果
	$row=mysql_fetch_row($result);

	$ret = $ret.htmlspecialchars_decode($row[1]);

	echo $ret;

	// 释放资源
	mysql_free_result($result);

	// 关闭连接
	mysql_close($conn);
 ?>