<?php
    //選択肢データの読み込み
    require_once("./choicesData.php");
    require_once("./secret/loginData.php");

    //エラー対応
    try{
        //データベースに接続する
        $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //リストアップ
        $sql = "SELECT * FROM travelPlans";
        $stmt = $dbh->query($sql);
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
        <title>リスト</title>
	</head>
	<body>
        <h1>旅行プランリスト</h1>
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
        <a href = "form.php">プランの新規登録</a>
    </body>
</html>