<?php
    //選択肢データの読み込み
    require_once("./choicesData.php");
    //アップローダーの読み込み
    require_once("./imageUpload.php");
    require_once("./secret/loginData.php");

    //データの受け取り
    $data = $_POST;
    
    $planName = $data["planName"];
    $area = (int)$data["area"];
    $terminal = $data["terminal"];
    $access = (int)$data["access"];
    $accessDetails = $data["accessDetails"];
    $time = (int)$data["time"];
    $budget = (int)$data["budget"];
    $planDetails = $data["planDetails"];

    //画像を更新する場合アップロードする
    if($data["imageReuse"] == "1"){
        $photo = $data["photoURL"];
    }else{
        $uploadResult = imageUpload($_FILES["photo"]);
        $photo = $uploadResult[1];
    }
        
    //エラー対応
    try{
        //idが受け取れたか確認する
        if(empty($_POST["id"])){
            throw new Exception("IDが不正です");
        }
        //idを取得する
        $id = (int)$_POST["id"];
        
        //データベースに接続する
        $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //データベースに入力内容を格納する
        $sql = "UPDATE travelPlans SET planName = ?, area = ?, terminal = ?, access = ?, accessDetails = ?, time = ?, budget = ?, planDetails = ?, photo = ? WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        
        $stmt->bindValue(1, $planName, PDO::PARAM_STR);
        $stmt->bindValue(2, $area, PDO::PARAM_INT);
        $stmt->bindValue(3, $terminal, PDO::PARAM_STR);
        $stmt->bindValue(4, $access, PDO::PARAM_INT);
        $stmt->bindValue(5, $accessDetails, PDO::PARAM_STR);
        $stmt->bindValue(6, $time, PDO::PARAM_INT);
        $stmt->bindValue(7, $budget, PDO::PARAM_INT);
        $stmt->bindValue(8, $planDetails, PDO::PARAM_STR);
        $stmt->bindValue(9, $photo, PDO::PARAM_STR);    
        $stmt->bindValue(10, $id, PDO::PARAM_INT);
        
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
        <title>入力完了</title>
	</head>
	<body>
        情報が更新されました。<br><br>
        
        ■入力内容
        
        プラン名：
        <?php
            echo htmlspecialchars($data["planName"],ENT_QUOTES,"UTF-8")
        ?>
        <br>
        
        地方：<?= $areaName[$data["area"]] ?>
        <br>
        
        ターミナル：
        <?php
            echo htmlspecialchars($data["terminal"],ENT_QUOTES,"UTF-8")
        ?>
        <br>
        
        アクセス手段：<?= $accessName[$data["access"]] ?>
        <br>
        
        アクセス詳細：<br>
        <?php
            echo nl2br(htmlspecialchars($data["accessDetails"],ENT_QUOTES,"UTF-8"))
        ?>
        <br>
        
        観光所要時間：<?= $timeName[$data["time"]] ?>
        <br>
        
        予算：
        <?php
            if(is_numeric($data["budget"])){
                echo number_format($data["budget"]);
            }
        ?>
        円<br>
        
        詳細プランと見所：<br>
        <?php
            echo nl2br(htmlspecialchars($data["planDetails"],ENT_QUOTES,"UTF-8"))
        ?>
        <br><br>
        
        ■写真<br>
        <?php
            if ($photo!=""){
                echo "<img src=". $photo. ">";
            } elseif($uploadResult[0]==0) {
                echo "アップロードされませんでした：". $uploadResult[1];
            } else {
                echo "画像はありません";
            }
        ?>
        
        <br>
        
        <a href = index.php>リストに戻る</a>
    </body>
</html>