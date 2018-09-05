<?php
    $dsn = getenv('DB_NAME');
    $user = getenv('DB_USER');
	$password = getenv('DB_PASSWORD');
	$pdo = new PDO($dsn, $user, $password);

	/* コメント用テーブル作成 */
	/*
	$sql_comment = "CREATE TABLE 4_comments"
		."("
		."id INT,"
		."name char(32),"
		."comment TEXT"
		.");";
	$stmt_comment = $pdo -> query($sql_comment);
	*/

	/* パスワード用テーブル */
	$sql_password = "CREATE TABLE 4_passwords"
		."("
		."id INT,"
		."password char(32)"
		.");";
	$stmt_password = $pdo -> query($sql_password);
?>
