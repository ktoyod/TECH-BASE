<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>mission_1-7</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="text" name="comment" value="コメント">
            <input type="submit" value="送信">
        </form>
        <?php
            $filename = "mission_1-7_toyoda.txt";
            if (!empty($_POST["comment"])) {
            	$fp = fopen($filename, 'a');
            	$comment = $_POST["comment"]."\n";
            	fwrite($fp, $comment);
            	fclose($fp);
            }
            if (file_exists($filename)) {
                $lines = file($filename);
                foreach ($lines as $line) {
                	echo $line."<br>";
                }
            }	
        ?>
    </body>
<html>
