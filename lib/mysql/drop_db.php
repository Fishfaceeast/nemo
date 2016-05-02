<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/4/21
 * Time: 下午10:44
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
	$sql = 'DROP DATABASE USER';
	$retval = mysql_query( $sql, $conn );
	if(!$retval )
	{
		die('fail to drop database: ' . mysql_error());
	}
	echo "success to drop database user \n";
	mysql_close($conn);
