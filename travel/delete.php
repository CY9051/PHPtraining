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
        $sqlS = "SELECT * FROM travelPlans WHERE id = ?";
        $stmt = $dbh->prepare($sqlS);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        //該当idのプランをデータベースから削除
        $sqlD = "DELETE FROM travelPlans WHERE id = ?";
        $stmt = $dbh->prepare($sqlD);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        
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
        <title><?= $result["planName"] ?>の削除</title>
	</head>
	<body>
        <h1>旅行プラン「<?= htmlspecialchars($result["planName"], ENT_QUOTES, "UTF-8") ?>」（ID：<?= $id ?>）を削除しました。</h1>
        地方：<?= $areaName[$result["area"]] ?>
        <br>
        
        ターミナル：
        <?php
            echo htmlspecialchars($result["terminal"],ENT_QUOTES,"UTF-8")
        ?>
        <br>
        
        アクセス手段：<?= $accessName[$result["access"]] ?>
        <br>
        
        アクセス詳細：<br>
        <?php
            echo nl2br(htmlspecialchars($result["accessDetails"],ENT_QUOTES,"UTF-8"))
        ?>
        <br>
        
        観光所要時間：<?= $timeName[$result["time"]] ?>
        <br>
        
        予算：
        <?php
            if(is_numeric($result["budget"])){
                echo number_format($result["budget"]);
            }
        ?>
        円<br>
        
        詳細プランと見所：<br>
        <?php
            echo nl2br(htmlspecialchars($result["planDetails"],ENT_QUOTES,"UTF-8"))
        ?>
        <br><br>
        
        <a href = index.php>リストに戻る</a>
    </body>
</html>