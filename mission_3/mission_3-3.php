<?php
    $dsn = getenv('DB_NAME');
    $user = getenv('DB_USER');
	$password = getenv('DB_PASSWORD');
	$pdo = new PDO($dsn, $user, $password);

	$sql = 'SHOW TABLES';
	$result = $pdo -> query($sql);
	foreach ($result as $row) {
		echo $row[0];
		echo '<br>';
	}
	echo "<hr>";
?>
