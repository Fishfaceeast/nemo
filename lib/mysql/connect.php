<?php
//	$dsn = 'mysql:host=127.0.0.1;port=3306;dbname=reader;charset=utf8';
//	$username = 'xiaoxi';
//	$password = 'xiaoxi';
//
//	try {
//		$conn = new PDO($dsn, $username, $password);
//		echo "Connected successfully";
//	}
//	catch(PDOException $e)
//	{
//		echo $e->getMessage();
//	}
	$dbhost = '127.0.0.1:3306';  //mysql服务器主机地址
	$dbuser = 'xiaoxi';      //mysql用户名
	$dbpass = 'xiaoxi';//mysql用户名密码
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	if(!$conn )
	{
		die('Could not connect: ' . mysql_error());
	}
	echo 'Connected successfully';
	mysql_close($conn);
