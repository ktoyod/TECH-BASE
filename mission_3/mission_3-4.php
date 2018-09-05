<?php
    $dsn = getenv('DB_NAME');
    $user = getenv('DB_USER');
	$password = getenv('DB_PASSWORD');
	$pdo = new PDO($dsn, $user, $password);

	$sql = 'SHOW CREATE TABLE tbtest';
	$result = $pdo -> query($sql);
	foreach ($result as $row) {
		print_r($row);
	}
	echo "<hr>";
?>
