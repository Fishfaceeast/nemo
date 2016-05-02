<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/4/22
 * Time: 上午7:31
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
	$sql = "CREATE TABLE nemo_user( ".
		   "user_id INT NOT NULL AUTO_INCREMENT, ".
		   "user_mobile VARCHAR(20) NOT NULL, ".
		   "user_email VARCHAR(40) NOT NULL, ".
		   "user_password VARCHAR(6) NOT NULL, ".
		   "user_gender VARCHAR(10) NOT NULL, ".
		   "user_orientation VARCHAR(40) NOT NULL, ".
		   "user_address VARCHAR(40) NOT NULL, ".
		   "submission_date DATE, ".
		   "PRIMARY KEY ( user_id )); ";
	mysql_select_db( 'NEMO' );
	$retval = mysql_query( $sql, $conn );
	if(!$retval )
	{
		die('fail to create table: ' . mysql_error());
	}
	echo "success to create table nemo_user \n";
	mysql_close($conn);
