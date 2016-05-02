<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/4/24
 * Time: 上午11:10
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

	$sql = "SHOW COLUMNS FROM tasks;";
	mysql_select_db( 'NEMO' );
	$retval = mysql_query( $sql, $conn );
	if(!$retval )
	{
		die('fail to SHOW COLUMNS FROM NEMO: ' . mysql_error());
	}
	echo "success to SHOW COLUMNS FROM NEMO \n";
	while($row = mysql_fetch_array($retval)){
		echo 'Field name：'.$row['Field'].'-Type：'.$row['Type'].'-Comment：'.$row['Comment'];
		echo '<br/>';
		print_r($row);
	}
	mysql_close($conn);
