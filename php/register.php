<?php 
	// echo $_POST["username"];
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

	// 从表中提取信息的sql语句
	$strsql="SELECT * FROM `dongbaouser` WHERE username='".$_POST["username"]."';";

	// 执行sql查询
	$result=mysql_db_query($mysql_database, $strsql, $conn);

	// 获取查询结果
	$row=mysql_fetch_row($result);

	// echo count($row);

	if(count($row) >= 5) {
		echo '<script language="javascript">';
		echo 'location.href="../register_fail.html"';
		echo '</script>';
	} else {
		$strsql = "INSERT INTO `test`.`dongbaouser` (`username`, `password`, `valid`, `invitation`) VALUES ('".$_POST['username']."', '".$_POST['password']."', '1', '123456');";
		// 执行sql查询
		$result=mysql_db_query($mysql_database, $strsql, $conn);
		echo '<script language="javascript">';
		echo 'location.href="../register_success.html"';
		echo '</script>';
	}
	
	// 释放资源
	mysql_free_result($result);

	// 关闭连接
	mysql_close($conn);  
?>