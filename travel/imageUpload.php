<?php
    function imageUpload($upIMG){
        //$upIMG: $_FILES["photo"]
        //戻り値：成功すると[1, ファイル名]、失敗すると[0, エラー名]
        //保存先フォルダの作成
        if(!file_exists("./upfile/")){
        mkdir("./upfile/");
        }
        
        //送信された画像データがあるか確認
        if(isset($upIMG)){
            //ファイル名があるか確認
            if(!empty($upIMG["tmp_name"])){
                //アップロード位置と名前を設定
                $upName="./upfile/".$upIMG["name"];
                
                //アップロード処理
                if(move_uploaded_file($upIMG["tmp_name"],$upName)){
                    //アップロード成功
                    $uploadResult = [1, $upName];
                }else{
                    //アップロード失敗
                    $uploadResult = [0,"failured"];
                }
            }else{
                //写真がアップロードされていない
                $uploadResult = [0, "noImage"];
            }
        }
        return $uploadResult;
    }
?>