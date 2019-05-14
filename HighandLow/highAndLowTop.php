<?php
	//array関数を使ってトランプの画像名を配列で作成
	$cards=array("Jk.png","01.png","02.png","03.png","04.png","05.png","06.png",
			"07.png","08.png","09.png","10.png","11.png","12.png","13.png");

	//左のカードの値をランダムで生成
	$leftCard=mt_rand(0,13);
?>

<html>
	<head>
		<meta http-equiv="Content-Type"content="text/html;charset=UTF-8">
	</head>

	<body>
		<!--タイトルと区切り線-->
		<div style="text-align:center">
			<font size ="16">High&Lowゲーム</font><br>
			<hr>
				<!--フォーム-->
				<form action ="highAndLowResult.php" method="post">
				<?php
					//カードを表示
					echo '<img src="../cards/',$cards[$leftCard],'">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<img src="../cards/bg.png"><br>';
					//隠しフィールド
					echo '<input type="hidden" name="leftCard" value=',$leftCard,'>';
				?>
				<br>

				<!--ラジオボタン-->
				<input type="radio" name="select" value="High">High
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" name="select" value="Low">Low
				<br><br>

				<!--実行ボタン-->
				<input type="submit" value="決定">
				</form>
		</div>
	</body>
</html>