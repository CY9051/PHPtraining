<?php
    //選択肢データの読み込み
    require_once("./choicesData.php");
?>

<html>
	<head>
		<meta http-equiv="Content-Type"content="text/html;charset=UTF-8">
        <title>プランの検索</title>
	</head>
	<body>
        <h1>プランの検索</h1>
        *は選択必須項目です。<br><br>
        
        <form action="searchList.php" method = "get">
            ■希望エリア*
            <select name="pArea" required>
            <?php foreach($areaName as $areaNum => $eachArea){ ?>
            <option value="<?= $areaNum ?>"><?= $eachArea ?></option>
            <?php } ?>
            </select>
            <br><br>
            
            ■希望アクセス手段*
            <?php foreach($accessName as $accessNum => $eachAccess){ ?>
            <input type="radio" name="pAccess" value="<?= $accessNum ?>" required><?= $eachAccess ?> &emsp;
            <?php } ?>
            <br><br>
            
            ■希望予算
            <input type="number" min="0" max="1000000" name="pBudget">
            円以下
            <br><br>
            
            ■プラン詳細に
            <input type="text" name = "pWord">
            を含む
            <br><br>
            
            <input type="submit" value="検索">
        </form>
        
        <br>
        <a href = "form.php">プランの新規登録</a><br>
        <a href = "index.php">一覧に戻る</a>
    </body>
</html>