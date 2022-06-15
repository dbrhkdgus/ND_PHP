<?php
    require_once($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\DataBase\connection.php');

    $mode = $_GET["mode"];
    if($mode === 'update'){
        // 아래 3줄 (7~9) 메소드화 했으면 좋겠음.
        $jsonStr = $_GET["jsonStr"];
        $info = json_decode($jsonStr, true);
        $tel = $info["tel1"].'-'.$info["tel2"].'-'.$info["tel3"];
        $sql = 'update item_order_info set name = \''.$info["name"].'\', email = \''.$info["email"].'\', tel = \''.$tel.'\', memo = \''.$info["memo"].'\' where id = '.$_GET["id"];

        $result = connect($sql);

        echo '발주처 정보가 수정되었습니다.';



    }else if($mode === 'insert'){
        $jsonStr = $_GET["jsonStr"];
        $info = json_decode($jsonStr, true);
        $tel = $info["tel1"].'-'.$info["tel2"].'-'.$info["tel3"];

        $sql = 'insert into item_order_info (name, email, tel, memo) values(\''.$info["name"].'\', \''.$info["email"].'\', \''.$tel.'\', \''.$info["memo"].'\')';
        $result = connect($sql);

        echo '발주처가 새로 등록되었습니다.';



    }else if($mode === 'delete'){
        $sql = 'delete from item_order_info where id = '.$_GET["id"];
        $result = connect($sql);

        echo '삭제되었습니다.';
    }

?>