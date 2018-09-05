<?php
    $dsn = getenv('DB_NAME');
    $user = getenv('DB_USER');
	$password = getenv('DB_PASSWORD');
	$pdo = new PDO($dsn, $user, $password);

	$sql = 'SELECT * FROM tbtest';
	$result = $pdo -> query($sql);
	foreach ($result as $row) {
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].'<br>';
	}
?>
