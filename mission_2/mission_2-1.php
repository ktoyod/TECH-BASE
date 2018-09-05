<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>mission_2-1</title>
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
            $filename = "mission_2-1_toyoda.txt";
            if (file_exists($filename)) {
                $lines = file($filename);
				$num = count($lines) + 1;
			} else {
				$num = 1;
			}	
			$name = $_POST["name"];
            $comment = $_POST["comment"];
            if (!empty($name) && !empty($comment)) {
            	$fp = fopen($filename, 'a');
                $date = date("Y/m/d H:i:s");
				$data = "${num}<>${name}<>${comment}<>${date}\n";
            	fwrite($fp, $data);
            	fclose($fp);
            }
        ?>
    </body>
<html>
