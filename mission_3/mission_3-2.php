<?php
    $dsn = getenv('DB_NAME');
    $user = getenv('DB_USER');
	$password = getenv('DB_PASSWORD');
	$pdo = new PDO($dsn, $user, $password);

	$sql = "CREATE TABLE tbtest"
		."("
		."id INT,"
		."name char(32),"
		."comment TEXT"
		.");";
	$stmt = $pdo -> query($sql);
?>
