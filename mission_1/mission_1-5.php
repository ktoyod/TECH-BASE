<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>mission1-4</title>
  </head>
  <body>
    <form method="POST" action="">
      <input type="text" name="data" value="コメント">
      <input type="submit" value="送信">
    </form>
    <?php
      if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["data"])) {
	    $data = $_POST["data"];
		if ($data === "完成！") {
		  $filename = "mission_1-5_toyoda.txt";
		  $fp = fopen($filename, 'w');
		  fwrite($fp, $data);
	      echo "おめでとう！";
		  fclose($fp);
		} else {
		  $filename = "mission_1-5_toyoda.txt";
		  $fp = fopen($filename, 'w');
          $date = date("Y/m/d H:i");
		  fwrite($fp, $data);
	      echo "ご入力ありがとうございます。<br>${date}に${data}を受け付けました。";
		  fclose($fp);
		}
      }
	?>
  </body>
</html>
