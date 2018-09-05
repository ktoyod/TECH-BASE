<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>mission_2-3</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="text" name="name" placeholder="名前"><br>
            <input type="text" name="comment" placeholder="コメント">
            <input type="submit" value="送信"><br>
        </form>
        <br>
        <form action="" method="post">
            <input type="text" name="remove_num" placeholder="削除対象番号">
            <input type="submit" value="削除">
        </form>
        
        <?php
            /***** 変数の定義 *****/
            $filename = "mission_2-3_toyoda.txt";
			$name = $_POST["name"];
            $comment = $_POST["comment"];
			$remove_num = $_POST["remove_num"];

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
            if (!empty($name) && !empty($comment)) {
            	$fp = fopen($filename, 'a');
                $date = date("Y/m/d H:i:s");
				$data = "${num}<>${name}<>${comment}<>${date}\n";
            	fwrite($fp, $data);
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
