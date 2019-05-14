<?php
    //選択肢データの読み込み
    require_once("./choicesData.php");
    require_once("./secret/loginData.php");

    //エラー取得
    try{
        //プランidを取得できるか調べる
        if(empty($_GET["id"])){
            throw new Exception("プランidが取得できませんでした");
        }
        //取得できた場合、プランidの取得
        $id = (int)$_GET["id"];
        
        //データベースに接続する
        $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //該当idのプランをデータベースから取得
        $sql = "SELECT * FROM travelPlans WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        //データベースとの接続を切る
        $dbh = null;
        
    //エラー表示
    } catch(Exception $e) {
        echo "エラー：". htmlspecialchars($e->getMessage(),ENT_QUOTES, "UTF-8"). "<br>";
        die();
    }
?>

<html>
	<head>
		<meta http-equiv="Content-Type"content="text/html;charset=UTF-8">
        <title>プランid：<?= htmlspecialchars($id, ENT_QUOTES, "UTF-8") ?>の編集フォーム</title>
	</head>
	<body>
        <h1>プランid：<?= htmlspecialchars($id, ENT_QUOTES, "UTF-8") ?>の編集フォーム</h1>
        *：記入必須項目<br><br>
        
        <form action="editResult.php" method="post" enctype="multipart/form-data">
        旅行プラン*：<input type="text" name="planName" value= "<?= htmlspecialchars($result["planName"], ENT_QUOTES, "UTF-8") ?>" required><br><br>
            
        地方：<select name="area">
            <?php foreach($areaName as $areaNum => $eachArea){?>
            <option value="<?= $areaNum ?>" <?php if($result["area"] == $areaNum) echo "selected" ?>>
                <?= $eachArea ?>
            </option>
            <?php } ?>
            </select><br>
            
        ターミナル：<input type="text" name="terminal" value = "<?= htmlspecialchars($result["terminal"], ENT_QUOTES, "UTF-8") ?>"><br>
            
        アクセス手段：
        <?php foreach($accessName as $accessNum => $eachAccess){ ?>
            <input type="radio" name="access" value="<?= $accessNum ?>" <?php if($result["access"] == $accessNum) echo "checked" ?>><?= $eachAccess ?> &emsp;
            <?php } ?>
        <br>
            
        アクセス詳細<br>
        <textarea name="accessDetails" cols="50" rows="3" maxlength="500"><?= htmlspecialchars($result["accessDetails"], ENT_QUOTES, "UTF-8") ?></textarea><br><br>
            
        観光所要時間（ターミナルからの移動時間込み）：
        <?php foreach($timeName as $timeNum => $eachTime){ ?>
            <input type="radio" name="time" value="<?= $timeNum ?>" <?php if($result["time"] == $timeNum) echo "checked" ?>><?= $eachTime ?> &emsp;
            <?php } ?>
        <br>
            
        予算（ターミナルからの移動費用込み）：
        <input type="number" min="0" max="1000000" name="budget" value = "<?= htmlspecialchars($result["budget"], ENT_QUOTES, "UTF-8") ?>">円<br><br>
            
        詳細プランと見所*:<br>
        <textarea name="planDetails" cols="50" rows="10" maxlength="1000" required><?= htmlspecialchars($result["planDetails"], ENT_QUOTES, "UTF-8") ?></textarea><br><br>
            
        ★写真：<input type="file" name="photo" accept="image/*"><br>
        ※旧イメージ画像<br>
        <!-- チェックボックスに値が入っていない場合0を送る-->
        <input type="hidden" name="imageReuse" value="0">
        <input type="checkbox" name="imageReuse" value="1" checked>このイメージを引き続き使う（上記で選択した画像は使われません）
        <br>
        <?php
            if($result["photo"]!=""){
                echo "<img src = ". htmlspecialchars($result["photo"], ENT_QUOTES, "UTF-8"). ">";
                }else {
                    echo "画像はアップロードされていません";
                }
        ?>
        <br>
            
        <!-- idを非表示データで送る -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($result["id"], ENT_QUOTES, "UTF-8") ?>">
        <!--旧画像データを非表示データで送る-->
        <input type="hidden" name="photoURL" value="<?=htmlspecialchars($result["photo"], ENT_QUOTES, "UTF-8")?>">
        
        <input type="submit" value="変更する">
        </form>
        
        <br>
        
        <a href = index.php>リストに戻る</a>
    </body>
</html>
