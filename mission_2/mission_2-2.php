<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>mission_2-2</title>
    </head>
    <body>
        <form action="" method="post">
            <label>名前：</label>
            <input type="text" name="name"><br>
            <label>コメント：</label>
            <input type="text" name="comment"><br>
            <input type="submit" value="送信">
        </form>
        <?php
            /***** 変数の定義 *****/
            $filename = "mission_2-2_toyoda.txt";
			$name = $_POST["name"];
            $comment = $_POST["comment"];

			/***** 投稿番号の取得 *****/
            if (file_exists($filename)) {
                $lines = file($filename);
				$num = count($lines) + 1;
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
