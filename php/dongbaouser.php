<?php
	echo '下面展示php连接MySQL的local数据库中的dongbaouser表：</br>';
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
	$strsql="SELECT * FROM `dongbaouser`";

	// 执行sql查询
	$result=mysql_db_query($mysql_database, $strsql, $conn);

	// 获取查询结果
	$row=mysql_fetch_row($result);

	echo '<table border="1" cellpadding="1" cellspacing="2">';

	// 显示字段名称
	echo "<tr>";

	for ($i=0; $i<mysql_num_fields($result); $i++)
	{
		echo '<td bgcolor="#FFFFFF"><b>'.
		mysql_field_name($result, $i);
		echo "</td>";
	}
	echo "</tr>";

	// 定位到第一条记录
	mysql_data_seek($result, 0);

	// 循环取出记录
	while ($row=mysql_fetch_row($result))
	{
		echo "<tr>";
		for ($i=0; $i<mysql_num_fields($result); $i++ )
		{
			echo '<td bgcolor="#FFFFFF">';
			echo $row[$i];
			echo '</td>';
		}
		echo "</tr>";
	}

	echo "</table>";

	// 释放资源
	mysql_free_result($result);

	// 关闭连接
	mysql_close($conn);  
?>