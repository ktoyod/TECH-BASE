<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>mission_2-4</title>
    </head>
    <body>
        <!-- 投稿用フォーム -->
        <?php
            $filename = "mission_2-4_toyoda.txt";
			$edit_num = $_POST["edit_num"];
			if(!empty($edit_num)) {
				$lines = file($filename);
				foreach ($lines as $line) {
					list($fnum, $fname, $fcomment, $fdate) = explode("<>", $line);
					if ($fnum === $edit_num) {
						echo '
                            <form action="" method="post">
                                <input type="text" name="name" placeholder="名前" value="'.$fname.'"><br>
                                <input type="text" name="comment" placeholder="コメント" value="'.$fcomment.'">
                                <input type="hidden" name="edit_flag" value="'.$edit_num.'">
                                <input type="submit" value="送信"><br>
							</form>
                        ';
			        }
				}
			} else {
				echo '
                    <form action="" method="post">
                        <input type="text" name="name" placeholder="名前"><br>
                        <input type="text" name="comment" placeholder="コメント">
                        <input type="hidden" name="edit_flag">
                        <input type="submit" value="送信"><br>
					</form>
                ';

			}
        ?>
        <br>
        <!-- 削除用フォーム -->
        <form action="" method="post">
            <input type="text" name="remove_num" placeholder="削除対象番号">
            <input type="submit" value="削除">
        </form>
        <!-- 編集番号指定用フォーム -->
        <form action="" method="post">
            <input type="text" name="edit_num" placeholder="編集対象番号">
            <input type="submit" value="編集">
        </form>
        
        <?php
            /***** 変数の定義 *****/
            $filename = "mission_2-4_toyoda.txt";
			$name = $_POST["name"];
            $comment = $_POST["comment"];
			$remove_num = $_POST["remove_num"];
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
            if (!empty($name) && !empty($comment) && empty($edit_flag)) {
            	$fp = fopen($filename, 'a');
                $date = date("Y/m/d H:i:s");
				$data = "${num}<>${name}<>${comment}<>${date}\n";
            	fwrite($fp, $data);
            	fclose($fp);
            }

			/***** edit_flagが立っているときに編集 *****/
            if (!empty($name) && !empty($comment) && !empty($edit_flag)) {
				// TODO: CHECK
				$lines = file($filename);
				$fp = fopen($filename, 'w');
				foreach ($lines as $line) {
					list($fnum, $fname, $fcomment, $fdate) = explode("<>", $line);
					if ($fnum === $edit_flag) {
                        $date = date("Y/m/d H:i:s");
				        $data = "${fnum}<>${name}<>${comment}<>${date}\n";
            	        fwrite($fp, $data);
						continue;
					}
					fwrite($fp, $line);
				}
				fclose($fp);
            }

			/***** 指定された番号の投稿を削除 *****/
			if (!empty($remove_num)) {
				$lines = file($filename);
				$fp = fopen($filename, 'w');
				foreach ($lines as $line) {
					list($fnum, $fname, $fcomment, $fdate) = explode("<>", $line);
					if ($fnum === $remove_num) {
						continue;
					}
					fwrite($fp, $line);
				}
				fclose($fp);
			}

			/***** 編集対象番号が送信された時の処理 *****/
			/*
			if(!empty($edit_num)) {
				$lines = file($filename);
				foreach ($lines as $line) {
					list($fnum, $fname, $fcomment, $fdate) = explode("<>", $line);
					if ($fnum === $edit_num) {
						// TODO: ADD
						// formへの値を入れるところで苦戦しそうかも？
						$dom = new DomDocument();
						$dom->load('mission_2-4.php');
						$xp = new DomXPath($dom);
						$dom_name = $xp->query("//*[@id = 'post_name']");
						$dom_comment = $xp->query("//*[@id = 'post_comment']");
						$dom_flag = $xp->query("//*[@id = 'post_flag']");
						$dom_name->item(0)->setAttribute('value', $fname);
						$dom_comment->item(0)->setAttribute('value', $fcomment);
						$dom_flag->item(0)->setAttribute('value', $edit_num);
					}
				}
			}
			*/

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
