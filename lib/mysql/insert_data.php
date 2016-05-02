<html>
<head>
	<title>Add data to NEMO.nemo_user</title>
</head>
<body>
	<?php
		if(isset($_POST['add'])) {
			$dbhost = '127.0.0.1:3306';
			$dbuser = 'xiaoxi';
			$dbpass = 'xiaoxi';
			$conn = mysql_connect($dbhost, $dbuser, $dbpass);
			if(!$conn )
			{
				die('Could not connect: ' . mysql_error());
			}

			if(!get_magic_quotes_gpc() ) {
				$user_mobile = addslashes($_POST['user_mobile']);
				$user_email = addslashes($_POST['user_email']);
				$user_password = addslashes($_POST['user_password']);
				$user_gender = addslashes($_POST['user_gender']);
				$user_orientation = addslashes($_POST['user_orientation']);
				$user_address = addslashes($_POST['user_address']);
			} else {
				$user_mobile = $_POST['user_mobile'];
				$user_email = $_POST['user_email'];
				$user_password = $_POST['user_password'];
				$user_gender = $_POST['user_gender'];
				$user_orientation = $_POST['user_orientation'];
				$user_address = $_POST['user_address'];
			}
			$submission_date = $_POST['submission_date'];

			$sql = "INSERT INTO nemo_user ".
				"(user_mobile, user_email, user_password, user_gender, user_orientation, user_address, submission_date) ".
				"VALUES ".
				"('$user_mobile', '$user_email', '$user_password', '$user_gender', '$user_orientation', '$user_address', '$submission_date')";
			mysql_select_db('NEMO');
			$retval = mysql_query( $sql, $conn );
			if(!$retval ) {
				die('Could not enter data: ' . mysql_error());
			}
			echo "Entered data successfully\n";
			mysql_close($conn);
		} else {
			?>
			<form method="post" action="<?php $_PHP_SELF ?>">
				<table width="600" border="0" cellspacing="1" cellpadding="2">
					<tr>
						<td width="250">User mobile</td>
						<td>
							<input name="user_mobile" type="number" id="user_mobile">
						</td>
					</tr>
					<tr>
						<td width="250">User email</td>
						<td>
							<input name="user_email" type="text" id="user_email">
						</td>
					</tr>
					<tr>
						<td width="250">user password</td>
						<td>
							<input name="user_password" type="number" id="user_password">
						</td>
					</tr>
					<tr>
						<td width="250">user gender</td>
						<td>
							<input name="user_gender" type="text" id="user_gender">
						</td>
					</tr>
					<tr>
						<td width="250">user orientation</td>
						<td>
							<input name="user_orientation" type="text" id="user_orientation">
						</td>
					</tr>
					<tr>
						<td width="250">user address</td>
						<td>
							<input name="user_address" type="text" id="user_address">
						</td>
					</tr>
					<tr>
						<td width="250">Submission Date [ yyyy-mm-dd ]</td>
						<td>
							<input name="submission_date" type="text" id="submission_date">
						</td>
					</tr>
					<tr>
						<td width="250"> </td>
						<td> </td>
					</tr>
					<tr>
						<td width="250"> </td>
						<td>
							<input name="add" type="submit" id="add" value="Add User">
						</td>
					</tr>
				</table>
			</form>
			<?php
		}
	?>
</body>
</html>
