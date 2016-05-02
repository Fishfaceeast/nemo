<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/4/21
 * Time: 下午11:00
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
	mysql_select_db( 'USER' );
	echo 'select User  OK<br />';
	mysql_close($conn);
