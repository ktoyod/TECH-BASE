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
      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $date = date("Y/m/d H:i");
	    $data = $_POST["data"];
	    echo "ご入力ありがとうございます。<br>${date}に${data}を受け付けました。";
      }
	?>
  </body>
</html>
