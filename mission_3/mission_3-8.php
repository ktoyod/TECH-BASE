<?php
    $dsn = getenv('DB_NAME');
    $user = getenv('DB_USER');
	$password = getenv('DB_PASSWORD');
	$pdo = new PDO($dsn, $user, $password);

	$id = 2;
	$sql = "delete from tbtest where id=$id";
	$result = $pdo -> query($sql);

	$select_sql = "SELECT * FROM tbtest";
	$select_result = $pdo -> query($select_sql);

	foreach ($select_result as $row) {
		echo $row['id'].','.$row['name'].','.$row['comment'].'<br>';
	}
?>
