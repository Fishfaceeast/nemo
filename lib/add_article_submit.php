<?php
	$input = $_POST;
	$dsn = 'mysql:host=127.0.0.1;port=3306;dbname=reader;charset=utf8';
	$user = 'xiaoxi';
	$password = 'xiaoxi';
	$db = new PDO($dsn, $user, $password); //连接数据库

	$sql = 'INSERT INTO `articles` (`author`, `title`, `content`) VALUES (' . '\'' . $input['author'] . '\',\'' . $input['title'] . '\',\'' . $input['content'] . '\');';

	$stmt = $db->query($sql); //执行SQL
	$id = $db->lastInsertId(); //获得自增id
	if (!empty($id)) {
		$notice = 'success save';
	} else {
		$notice = 'error';
	}
	$d = array();
	$d['notice'] = array(
		'msg' => $notice,
	);
	require_once __DIR__ . '/../view/notice.html';
