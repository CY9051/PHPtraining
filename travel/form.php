<?php
    //選択肢データの読み込み
    require_once("./choicesData.php");
?>


<html>
	<head>
		<meta http-equiv="Content-Type"content="text/html;charset=UTF-8">
        <title>入力フォーム</title>
	</head>
	<body>
        <h1>入力フォーム</h1>
        *：記入必須項目<br><br>
        
        <form action="formResult.php" method="post" enctype="multipart/form-data">
        旅行プラン*：<input type="text" name="planName" required><br><br>
            
        地方：<select name="area">
            <?php foreach($areaName as $areaNum => $eachArea){ ?>
            <option value="<?= $areaNum ?>"><?= $eachArea ?></option>
            <?php } ?>
            </select><br>
            
        ターミナル：<input type="text" name="terminal"><br>
            
        アクセス手段：
        <?php foreach($accessName as $accessNum => $eachAccess){ ?>
            <input type="radio" name="access" value="<?= $accessNum ?>"><?= $eachAccess ?> &emsp;
            <?php } ?>
        <br>
            
        アクセス詳細<br>
        <textarea name="accessDetails" cols="50" rows="3" maxlength="500"></textarea><br><br>
            
        観光所要時間（ターミナルからの移動時間込み）：
        <?php foreach($timeName as $timeNum => $eachTime){ ?>
            <input type="radio" name="time" value="<?= $timeNum ?>"><?= $eachTime ?> &emsp;
            <?php } ?>
        <br>
            
        予算（ターミナルからの移動費用込み）：
        <input type="number" min="0" max="1000000" name="budget">円<br><br>
            
        詳細プランと見所*:<br>
        <textarea name="planDetails" cols="50" rows="10" maxlength="1000" required></textarea><br>
            
        写真：<input type="file" name="photo" accept="image/*"><br><br>
        <input type="submit" value="送信">
        </form>
        
        <br>
        
        <a href = index.php>リストに戻る</a>
    </body>
</html>
