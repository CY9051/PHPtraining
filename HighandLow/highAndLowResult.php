<?php
	//array関数を使ってトランプの画像名を配列で作成
	$cards=array("Jk.png","01.png","02.png","03.png","04.png","05.png","06.png",
		"07.png","08.png","09.png","10.png","11.png","12.png","13.png");

	//右のカードの値をランダムで生成
	$rightCard=mt_rand(0,13);

	//左のカード
	$leftCard = $_POST["leftCard"];
	//High/Low選択
	$select = $_POST["select"];
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
			<?php
				//カード表示
				echo '<img src="../cards/',$cards[$leftCard],'">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<img src="../cards/',$cards[$rightCard],'"><br>';
				echo '「',$select,'」を選択しました。<br><br>';

				//大小判定
				if($leftCard < $rightCard){
					$result = "High";
				}
				elseif($leftCard > $rightCard){
					$result = "Low";
				}
				else{
					$result = select;
				}

				//勝敗判定
				if($select == $result){
					echo 'You Win!';
				}
				else{
					echo 'You Lose...';
				}
			?>
			<br><br>

			<!--最初のページに戻る-->
			<a href="highAndLowS03.php">もう一度挑戦</a>
		</div>
	</body>
</html>