<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>create or delete table</title>
    </head>
    <body>
        <form action="" method="POST">
			<button name="sub" type="submit" value="CREATE">CREATE</button><br>
			<button name="sub" type="submit" value="DELETE">DELETE</button><br>
        </form>
        <hr>           

        <?php
            /* DB関連変数 & 接続 */
            $dsn = getenv('DB_NAME');
            $user = getenv('DB_USER');
        	$password = getenv('DB_PASSWORD');
        	$pdo = new PDO($dsn, $user, $password);
        
			/* 押されたボタンによって処理 */
			if (isset($_POST["sub"])) {
				if ($_POST["sub"] === "CREATE") {
					/* コメント用テーブル作成 */
                	$sql_comment = "CREATE TABLE 4_comments"
                		."("
                		."id INT,"
                		."name char(32),"
                		."comment TEXT,"
						."date DATETIME"
                		.");";
	                $stmt_comment = $pdo -> query($sql_comment);
					$stmt_comment -> closeCursor();
					/* パスワード用テーブル作成 */
                	$sql_password = "CREATE TABLE 4_passwords"
                		."("
                		."id INT,"
                		."password char(32)"
                		.");";
                	$stmt_password = $pdo -> query($sql_password);
					$stmt_password -> closeCursor();
				} else if ($_POST["sub"] === "DELETE") {
        	        $sql = "DROP TABLE 4_comments, 4_passwords";
        	        $stmt = $pdo -> query($sql);
					$stmt -> closeCursor();
				}
			}

			/* テーブル確認 */
			$sql_show = "SHOW TABLES";
			$result = $pdo -> query($sql_show);
			foreach ($result as $row) {
				echo $row[0]."<br>";
			}
			$result -> closeCursor();
        ?>
    </body>
</html>
