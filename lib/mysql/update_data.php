<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/4/24
 * Time: 下午3:18
 */
	$dbhost = '127.0.0.1:3306';
	$dbuser = 'xiaoxi';
	$dbpass = 'xiaoxi';
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	if(!$conn )
	{
		die('Could not connect: ' . mysql_error());
	}
	$sql = 'UPDATE nemo_user
			SET user_mobile="1508888888"
		    WHERE user_gender="female"';

	mysql_select_db('NEMO');
	$retval = mysql_query( $sql, $conn );
	if(!$retval ) {
		die('Could not update data: ' . mysql_error());
	}
	echo "Updated data successfully\n";
	mysql_close($conn);
