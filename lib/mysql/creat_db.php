<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/4/12
 * Time: 下午9:46
 */
	$dbhost = '127.0.0.1:3306';
	$dbuser = 'xiaoxi';
	$dbpass = 'xiaoxi';
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	if(!$conn )
	{
		die('connect error: ' . mysql_error());
	}
	echo 'connect OK<br />';
	$sql = 'CREATE DATABASE NEMO';
	$retval = mysql_query( $sql, $conn );
	if(!$retval )
	{
		die('fail to create database: ' . mysql_error());
	}
	echo "success to create database NEMO \n";
	mysql_close($conn);
?>
