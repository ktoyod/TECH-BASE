<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ワクワク掲示板</title>
    </head>
    <body>
        <h1>ワクワク掲示板</h1>
        <br>
        <hr size=0.3>
        <h3>投稿用フォーム</h3>
        <?php
            /* DB接続用変数 */
            $dsn = getenv('DB_NAME');
            $user = getenv('DB_USER');
	        $password = getenv('DB_PASSWORD');
			/* DB名前 */
			$db_comment = "4_comments";
			$db_password = "4_passwords";

            /* PDOオブジェクト */
	        $pdo = new PDO($dsn, $user, $password);

			/* 削除用変数 */
			$remove_num = $_POST["remove_num"];
			$remove_password = $_POST["remove_password"];

			/* 指定された番号の投稿を削除 */
			if (!empty($remove_num)) {
				/* 削除処理 */
				$select_sql = "SELECT password FROM ${db_password} WHERE id=${remove_num}";
				$_result_pw = $pdo -> query($select_sql);
				$result_pw = $_result_pw -> fetch(PDO::FETCH_NUM);
				$result_password = $result_pw[0];
				if ($result_password !== $remove_password) {
				    echo 'パスワードが違います。';
					$_result_pw -> closeCursor();
				} else {
					$_result_pw -> closeCursor();
                    $delete_password = "DELETE FROM ${db_password} WHERE id=${remove_num}";
					$result = $pdo -> query($delete_password);
					$result -> closeCursor();
                    $delete_comment = "DELETE FROM ${db_comment} WHERE id=${remove_num}";
					$result = $pdo -> query($delete_comment);
					$result -> closeCursor();
				}
			}

			/* 編集用変数 */
			$edit_num = $_POST["edit_num"];
			$edit_password = $_POST["edit_password"];

			/* 投稿フォームの表示 */
			if(!empty($edit_num)) {
				$select_sql = "SELECT password FROM ${db_password} WHERE id=${edit_num}";
				$_result_pw = $pdo -> query($select_sql);
				$result_pw = $_result_pw -> fetch(PDO::FETCH_NUM);
				$result_password = $result_pw[0];
				if ($result_password === $edit_password) {
					$_result_pw -> closeCursor();
					$select_sql = "SELECT * FROM ${db_comment} WHERE id=${edit_num}";
					$result = $pdo -> query($select_sql);
					$result_fetch = $result -> fetch(PDO::FETCH_ASSOC);
				    echo '
                        <form action="" method="post">
                            <input type="text" name="name" placeholder="名前" value="'.$result_fetch["name"].'"><br>
                            <input type="text" name="comment" placeholder="コメント" value="'.$result_fetch["comment"].'"><br>
                            <input type="text" name="password" placeholder="パスワード">
                            <input type="hidden" name="edit_flag" value="'.$edit_num.'">
                            <input type="submit" value="送信"><br>
				    	</form>
                    ';
					$result -> closeCursor();
				} else {
					echo 'パスワードが違います。';
				    echo '
                        <form action="" method="post">
                            <input type="text" name="name" placeholder="名前"><br>
                            <input type="text" name="comment" placeholder="コメント"><br>
                            <input type="text" name="password" placeholder="パスワード">
                            <input type="hidden" name="edit_flag">
                            <input type="submit" value="送信"><br>
				    	</form>
                    ';
				}
			} else {
				echo '
                    <form action="" method="post">
                        <input type="text" name="name" placeholder="名前"><br>
                        <input type="text" name="comment" placeholder="コメント"><br>
                        <input type="text" name="password" placeholder="パスワード">
                        <input type="hidden" name="edit_flag">
                        <input type="submit" value="送信"><br>
					</form>
                ';
			}
        ?>
        <!-- 削除用フォーム -->
        <h3>削除用フォーム</h3>
        <form action="" method="post">
            <input type="text" name="remove_num" placeholder="削除対象番号"><br>
            <input type="text" name="remove_password" placeholder="パスワード">
            <input type="submit" value="削除">
        </form>
        <!-- 編集番号指定用フォーム -->
        <h3>編集番号指定用フォーム</h3>
        <form action="" method="post">
            <input type="text" name="edit_num" placeholder="編集対象番号"><br>
            <input type="text" name="edit_password" placeholder="パスワード">
            <input type="submit" value="編集">
        </form>
        <br>
        <hr size=0.3>
        
        <?php
			/***** 変数の用意 *****/
			/* 投稿関連変数 */
			$name = $_POST["name"];
            $comment = $_POST["comment"];
			$password = $_POST["password"];
			/* 編集用変数 */
			$edit_flag = $_POST["edit_flag"];

			/***** 投稿番号の取得 *****/
			$select_id_sql = "SELECT id FROM 4_comment";
			$sql_id = "SELECT id FROM ${db_comment}";
			$result_id = $pdo -> query($sql_id);
			$id_list = array();
			foreach ($result_id as $row) {
				array_push($id_list, $row['id']);
			}
			if ($id_list) {
				$next_id = max($id_list) + 1;
			} else {
				$next_id = 1;
			}
			$result_id -> closeCursor();

			/***** 投稿内容をDBに挿入 *****/
            if (!empty($name) && !empty($comment) && !empty($password) && empty($edit_flag)) {
                $date = date("Y-m-d H:i:s");
				/* コメント用DB */
			    $sql_comment = $pdo -> prepare("INSERT INTO ${db_comment} (id, name, comment, date) VALUES (:id, :name, :comment, :date)");
				$sql_comment -> bindParam(':id', $next_id, PDO::PARAM_INT);
				$sql_comment -> bindParam(':name', $name, PDO::PARAM_STR);
				$sql_comment -> bindParam(':comment', $comment, PDO::PARAM_STR);
				$sql_comment -> bindParam(':date', $date, PDO::PARAM_STR);
				$sql_comment -> execute();
				$sql_comment -> closeCursor();
				/* パスワード用DB */
			    $sql_password = $pdo -> prepare("INSERT INTO ${db_password} (id, password) VALUES (:id, :password)");
				$sql_password -> bindParam(':id', $next_id, PDO::PARAM_INT);
				$sql_password -> bindParam(':password', $password, PDO::PARAM_STR);
				$sql_password -> execute();
				$sql_password -> closeCursor();
            }

			/***** edit_flagが立っているときに編集 *****/
            if (!empty($name) && !empty($comment) && !empty($edit_flag)) {
                $date = date("Y-m-d H:i:s");
				/* コメント用DB */
			    $sql_comment = $pdo -> prepare("UPDATE ${db_comment} SET name=:name, comment=:comment, date=:date WHERE id=${edit_flag}");
				$sql_comment -> bindParam(':name', $name, PDO::PARAM_STR);
				$sql_comment -> bindParam(':comment', $comment, PDO::PARAM_STR);
				$sql_comment -> bindParam(':date', $date, PDO::PARAM_STR);
				$sql_comment -> execute();
				$sql_comment -> closeCursor();
				/* パスワード用DB */
				if (!empty($password)) {
			        $sql_password = $pdo -> prepare("UPDATE ${db_password} SET password=:password WHERE id=${edit_flag}");
				    $sql_password -> bindParam(':password', $password, PDO::PARAM_STR);
				    $sql_password -> execute();
				    $sql_password -> closeCursor();
			    }
            }

			/***** 投稿内容をフォームの下に表示 *****/
			$sql_all = "SELECT * FROM ${db_comment} ORDER BY id ASC";
			$result = $pdo -> query($sql_all);
		    foreach ($result as $row) {
				echo $row["id"]." ".$row["name"]." ".$row["date"]."<br>";
				echo " ".$row["comment"];
				echo "<hr size=".'0.1'." color="."#ddd".">";
			}
			$result -> closeCursor();
        ?>
    </body>
<html>
