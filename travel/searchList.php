<?php
    //選択肢データの読み込み
    require_once("./choicesData.php");
    require_once("./secret/loginData.php");

    //希望エリア
    if(empty($_GET["pArea"])){
        $pArea="*";
    }
    //取得できた場合、希望エリアの取得
        $pArea = (int)$_GET["pArea"];

    //希望アクセス手段
    if(empty($_GET["pAccess"])){
        $pAccess="*";
    } else {
    //取得できた場合、希望アクセス手段の取得
        $pAccess = (int)$_GET["pAccess"];
    }

    //希望予算
    if(empty($_GET["pBudget"])){
    //取得できない場合、すべて表示
        $pBudget="*";
    } else {
    //取得できた場合、希望予算の取得
        $pBudget= (int)$_GET["pBudget"];
    }

    //検索ワード
    if(empty($_GET["pWord"])){
    //取得できない場合、すべて表示
        $pWord="";
    } else {
    //取得できた場合、検索ワードの取得
        $pWord = $_GET["pWord"];
    }

    //エラー対応
    try{
        //データベースに接続する
        $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //検索してリストアップ
        $sql = "SELECT * FROM travelPlans WHERE area = ? AND access = ? AND budget <= ? AND planDetails LIKE ?";
        $stmt = $dbh->prepare($sql);
        
        $stmt -> bindValue(1, $pArea, PDO::PARAM_INT);
        $stmt -> bindValue(2, $pAccess, PDO::PARAM_INT);
        $stmt -> bindValue(3, $pBudget, PDO::PARAM_INT);
        $stmt -> bindValue(4, "%".$pWord."%", PDO::PARAM_STR);
        
        $stmt -> execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($result);
        
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
        <title>検索結果</title>
	</head>
	<body>
        <h1>検索結果</h1>
        条件：希望エリア→<?= $areaName[$pArea] ?>&emsp; 
        希望アクセス方法→<?= $accessName[$pAccess] ?>&emsp; 
        希望予算→<?= $pBudget ?> 円以下&emsp; 
        検索ワード→「<?= $pWord ?>」を含む
        <br>
        <table border="1">
            <tr>
            <th>プラン名</th>
            <th>地方</th>
            <th>ターミナル</th>
            <th>観光所要時間</th>
            <th>予算</th>
            </tr>
            <?php foreach($result as $row){ ?>
                <tr>
                    <!--プラン名と詳細リンク-->
                    <td><a href = "planDetail.php?id=<?=$row["id"]?>"><?= htmlspecialchars($row["planName"], ENT_QUOTES, "UTF-8") ?></a></td>
                    <!--エリア名-->
                    <td><?= $areaName[$row["area"]] ?></td>
                    <!--ターミナル名-->
                    <td><?= htmlspecialchars($row["terminal"], ENT_QUOTES, "UTF-8") ?></td>
                    <!--所要時間-->
                    <td><?= $timeName[$row["time"]] ?></td>
                    <!--予算-->
                    <td><?= number_format($row["budget"]) ?>円</td>
                    <!--編集画面-->
                    <td><a href = "edit.php?id=<?=$row["id"]?>">編集</a></td>
                    <!--削除-->
                    <td><a href = "delete.php?id=<?=$row["id"]?>">削除</a></td>
                </tr>
            <?php } ?>
        </table>
        <br>
        
        <a href = "form.php">プランの新規登録</a><br>
        <a href = "index.php">一覧に戻る</a>
    </body>
</html>