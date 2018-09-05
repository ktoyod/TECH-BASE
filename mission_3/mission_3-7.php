<?php
    $dsn = getenv('DB_NAME');
    $user = getenv('DB_USER');
	$password = getenv('DB_PASSWORD');
	$pdo = new PDO($dsn, $user, $password);

	$id = 1;
	$nm = "toyotoyo";
	$come = "I am swimmer";
	$sql = "update tbtest set name='$nm', comment='$come' where id=$id";
	$result = $pdo -> query($sql);

	$select_sql = "SELECT * FROM tbtest";
	$select_result = $pdo -> query($select_sql);

	foreach ($select_result as $row) {
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].'<br>';
	}
?>
