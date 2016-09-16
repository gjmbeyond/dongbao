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

	// 从表中提取信息的sql语句
	$strsql="SELECT * FROM `blog` where id=".$_POST['id'].";";

	// 执行sql查询
	$result=mysql_db_query($mysql_database, $strsql, $conn);

	// 获取查询结果
	$row=mysql_fetch_row($result);

	$ret = $ret.'<!DOCTYPE HTML>
				<html>
					<head>
						<title>'.$row[1].'</title>

						<meta charset="utf-8" />
						<meta name="viewport" content="width=device-width, initial-scale=1" />

						<link rel="stylesheet" href="../../assets/css/audioplayer.css" />

						<!-- Scripts -->
						<script src="../../assets/js/jquery.min.js"></script>
						<script src="../../assets/js/audioplayer.js"></script></head>
					<body>';

	$ret = $ret.htmlspecialchars_decode($row[6]);

	$ret = $ret.'<div id="wrapper_audio">
				<audio id="audio_player" preload="auto" controls></audio>
			</div><a href="../../index.html">返回首页</a>
<div id="label"></div>
<script>
$(document).ready(function(e) {	
	var counter = 0;
	if (window.history && window.history.pushState) {
		$(window).on("popstate", function () {
			window.history.pushState("forward", null, "#");
			window.history.forward(1);
			$("#label").html("第" + (++counter) + "次单击后退按钮。");
		});
	}
	window.history.pushState("forward", null, "#"); //在IE中必须得有这两行
	window.history.forward(1);
});
</script>
    </body><script type="text/javascript">
		$(document).ready(function(){
			var raw_source = $("p:contains(\'Asource\')").text()
			var source = raw_source.split("=")[1]
			console.log(source)
			document.getElementById("audio_player").src=source
			$(function(){
				$("audio").audioPlayer()
			})
		})
	</script></html>';

	echo $ret;

	// 释放资源
	mysql_free_result($result);

	// 关闭连接
	mysql_close($conn);
 ?>