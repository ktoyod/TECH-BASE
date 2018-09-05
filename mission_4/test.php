<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>TEST</title>
    </head>
    <body>
        <?php
            $a = "test";
        ?>
        <h1>hahaha</h1>
        <?php
            echo $a;
        ?>
        <br>
		以下、SQLテスト
        <hr>
        <?php
			/* DB接続 */
            $dsn = getenv('DB_NAME');
            $user = getenv('DB_USER');
        	$password = getenv('DB_PASSWORD');
        	$pdo = new PDO($dsn, $user, $password);
        
			/* データの挿入 */
			// for ($i = 0; $i < 10; $i++) {
			//     $sql = $pdo -> prepare("INSERT INTO 4_comments (id, name, comment) VALUES (:id, :name, :comment, :date)");
			//     $sql -> bindParam(':id', $i, PDO::PARAM_INT);
			//     $sql -> bindParam(':name', $name, PDO::PARAM_STR);
			//     $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
			//     $sql -> bindParam(':date', $date, PDO::PARAM_STR);
			// 	$name = "toyoda$i";
			// 	$comment = "comment$i";
			// 	$date = "2018-12-01 01:20:21";
			//     $sql -> execute();
			// 	$sql -> closeCursor();
			// }

			echo "<h3>コメント用DB</h3><br>";
			$sql = "SELECT * FROM 4_comments";
			$result = $pdo -> query($sql);
			foreach ($result as $row) {
			    echo $row["id"]."  ".$row["name"]."  ".$row["comment"]."  ".$row["date"];
				echo "<br>";
			}
			echo "<hr>";

			echo "<h3>パスワード用DB</h3><br>";
			$sql = "SELECT * FROM 4_passwords";
			$result = $pdo -> query($sql);
			foreach ($result as $row) {
			    echo $row["id"]."  ".$row["password"];
				echo "<br>";
			}
			echo "<hr>";

			$array1 = array(1,2,3,4,5);
			if ($array1) {
			    echo max($array1);
			    echo "<br>";
			} else {
				echo "OMG";
			    echo "<br>";
			}
			$array2 = array();
			if ($array2) {
			    echo max($array2);
			    echo "<br>";
			} else {
				echo "OMG";
			    echo "<br>";
			}
			echo "<hr>";
        ?>
    </body>
</html>
