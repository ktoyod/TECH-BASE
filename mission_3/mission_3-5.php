<?php
    $dsn = getenv('DB_NAME');
    $user = getenv('DB_USER');
	$password = getenv('DB_PASSWORD');
	$pdo = new PDO($dsn, $user, $password);

	$sql = $pdo -> prepare("INSERT INTO tbtest (id, name, comment) VALUES ('1', :name, :comment)");
	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	$name = 'toyoda';
	$comment = 'comment done!!';
	$sql -> execute();
?>
