<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/4/24
 * Time: 上午11:40
 */
	$dbhost = '127.0.0.1:3306';
	$dbuser = 'xiaoxi';
	$dbpass = 'xiaoxi';
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	if(!$conn )
	{
		die('Could not connect: ' . mysql_error());
	}
	$sql = 'SELECT user_id, user_mobile, user_email, user_password, user_gender, user_orientation, user_address, submission_date
			FROM nemo_user';

	mysql_select_db('NEMO');
	$retval = mysql_query( $sql, $conn );
	if(!$retval )
	{
		die('Could not get data: ' . mysql_error());
	}
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	{
		echo "ID :{$row['user_id']}  <br> ".
			 "MOBILE: {$row['user_mobile']} <br> ".
			 "EMAIL: {$row['user_email']} <br> ".
			 "PWD: {$row['user_password']} <br> ".
			 "GENDER: {$row['user_gender']} <br> ".
			 "ORIENTATION: {$row['user_orientation']} <br> ".
			 "ADDRESS: {$row['user_address']} <br> ".
			 "Submission Date : {$row['submission_date']} <br> ".
			 "--------------------------------<br>";
	}
	mysql_free_result($retval);
	echo "Fetched data successfully\n";
	mysql_close($conn);
