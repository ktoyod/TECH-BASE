<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>mission_2-5</title>
    </head>
    <body>
        <!-- 投稿用フォーム -->
        <?php
            /* ファイル名 */
            $filename = "mission_2-5_toyoda.txt";
			$filename_password = "mission_2-5_toyoda_password.txt";
			/* 削除用変数 */
			$remove_num = $_POST["remove_num"];
			$remove_password = $_POST["remove_password"];

			/***** 指定された番号の投稿を削除 *****/
			if (!empty($remove_num)) {
				/* リストの準備 */
				$lines = file($filename);
				$lines_pass = file($filename_password);
				/* ファイルオープン */
				$fp = fopen($filename, 'w');
				$fp_pass = fopen($filename_password, 'w');
				/* 削除処理 */
				foreach ($lines as $key => $line) {
					list($fnum, $fname, $fcomment, $fdate) = explode("<>", $line);
					list($_, $fpassword, $_) = explode("<>", $lines_pass[$key]);
					if ($fnum !== $remove_num) {
					    fwrite($fp, $line);
					    fwrite($fp_pass, $lines_pass[$key]);
						continue;
					}
					if ($fpassword === $remove_password) {
						continue;
					} else {
						echo 'パスワードが違います。';
				        fwrite($fp, $line);
				        fwrite($fp_pass, $lines_pass[$key]);
						continue;
					}
				}
				fclose($fp);
				fclose($fp_pass);
			}

			/* 編集用変数 */
			$edit_num = $_POST["edit_num"];
			$edit_password = $_POST["edit_password"];

			/* 投稿フォームの表示 */
			if(!empty($edit_num)) {
				$lines = file($filename);
				$lines_pass = file($filename_password);
				foreach ($lines as $key => $line) {
					list($fnum, $fname, $fcomment, $fdate) = explode("<>", $line);
					list($_, $fpassword, $_) = explode("<>", $lines_pass[$key]);
					if ($fnum === $edit_num) {
						if ($fpassword === $edit_password) {
						    echo '
                                <form action="" method="post">
                                    <input type="text" name="name" placeholder="名前" value="'.$fname.'"><br>
                                    <input type="text" name="comment" placeholder="コメント" value="'.$fcomment.'"><br>
                                    <input type="text" name="password" placeholder="パスワード">
                                    <input type="hidden" name="edit_flag" value="'.$edit_num.'">
                                    <input type="submit" value="送信"><br>
						    	</form>
                            ';
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
			        }
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
        名前には自分の名前を、コメントには適当に、パスワードは自分で決めて！<br>
        書き込んだり削除したり編集したりして見てほしいです！<br>
        <br>
        <!-- 削除用フォーム -->
        <form action="" method="post">
            <input type="text" name="remove_num" placeholder="削除対象番号"><br>
            <input type="text" name="remove_password" placeholder="パスワード">
            <input type="submit" value="削除">
        </form>
        <!-- 編集番号指定用フォーム -->
        <form action="" method="post">
            <input type="text" name="edit_num" placeholder="編集対象番号"><br>
            <input type="text" name="edit_password" placeholder="パスワード">
            <input type="submit" value="編集">
        </form>
        
        <?php
            /***** 変数の定義 *****/
			/* ファイル */
            $filename = "mission_2-5_toyoda.txt";
			$filename_password = "mission_2-5_toyoda_password.txt";
			/* 投稿 */
			$name = $_POST["name"];
            $comment = $_POST["comment"];
			$password = $_POST["password"];
			/* 編集用変数 */
			$edit_flag = $_POST["edit_flag"];

			/***** 投稿番号の取得 *****/
            if (file_exists($filename)) {
                $lines = file($filename);
				$last = end($lines);
				$last_list = explode("<>", $last);
				$num = intval($last_list[0]) + 1;
			} else {
				$num = 1;
			}

			/***** 投稿内容をファイルに保存 *****/
            if (!empty($name) && !empty($comment) && !empty($password) && empty($edit_flag)) {
				/* ファイルオープン */
            	$fp = fopen($filename, 'a');
				$fp_pass = fopen($filename_password, 'a');
				/* データ書き込み */
                $date = date("Y/m/d H:i:s");
				$data = "${num}<>${name}<>${comment}<>${date}\n";
            	fwrite($fp, $data);
				$pass_data = "${num}<>${password}<>\n";
				fwrite($fp_pass, $pass_data);
				/* ファイル閉じる */
            	fclose($fp);
            	fclose($fp_pass);
            }

			/***** edit_flagが立っているときに編集 *****/
            if (!empty($name) && !empty($comment) && !empty($edit_flag)) {
				/* リスト */
				$lines = file($filename);
				$lines_pass = file($filename_password);
				/* ファイルオープン */
				$fp = fopen($filename, 'w');
				$fp_pass = fopen($filename_password, 'w');
				foreach ($lines as $key => $line) {
					list($fnum, $fname, $fcomment, $fdate) = explode("<>", $line);
					list($_, $fpassword, $_) = explode("<>", $lines_pass[$key]);
					if ($fnum === $edit_flag) {
						/* 編集された投稿の書き込み */
                        $date = date("Y/m/d H:i:s");
				        $data = "${fnum}<>${name}<>${comment}<>${date}\n";
            	        fwrite($fp, $data);
						/* パスワードが編集されたら書き込み */
						if (!empty($password)) {
							$data_pass = "${fnum}<>${password}<>";
							fwrite($fp_pass, $data_pass);
						} else {
							fwrite($fp_pass, $lines_pass[$key]);
						}
						continue;
					}
					fwrite($fp, $line);
					fwrite($fp_pass, $lines_pass[$key]);
				}
				fclose($fp);
				fclose($fp_pass);
            }

			/***** ファイル内容をフォームの下に表示 *****/
			if (file_exists($filename)) {
                $lines = file($filename);
				$num = count($lines) + 1;
				foreach ($lines as $line) {
					list($fnum, $fname, $fcomment, $fdate) = explode("<>", $line);
					echo $fnum." ".$fname." ".$fcomment." ".$fdate."<br>";
				}
			}
        ?>
    </body>
<html>
