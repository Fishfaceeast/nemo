<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/5/1
 * Time: 下午2:55
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
	$sql = 'DROP TABLE tasks';
	mysql_select_db( 'NEMO' );
	$retval = mysql_query( $sql, $conn );
	if(!$retval )
	{
		die('fail to drop table: ' . mysql_error());
	}
	echo "success to drop table tasks\n";
	mysql_close($conn);
