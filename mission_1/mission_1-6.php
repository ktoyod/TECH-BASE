<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>mission_1-6</title>
  </head>
  <body>
    <form action="" method="post">
      <input type="text" name="comment" value="コメント">
	  <input type="submit" value="送信">
    </form>
    <?php
    if (!empty($_POST["comment"])) {
		$filename = "mission_1-6_toyoda.txt";
		$fp = fopen($filename, 'a');
		$comment = $_POST["comment"]."\n";
		fwrite($fp, $comment);
		echo $_POST["comment"]."をファイルに書き込みました";
		fclose($fp);
	}
    ?>
  </body>
<html>
