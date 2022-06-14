<?php
    require_once($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\DataBase\connection.php');

    $mode = $_GET["mode"];
    if($mode === 'update'){
        $jsonStr = $_GET["jsonStr"];
        $info = json_decode($jsonStr, true);
        $tel = $info["tel1"].'-'.$info["tel2"].'-'.$info["tel3"];
        $sql = 'update item_order_info set name = \''.$info["name"].'\', email = \''.$info["email"].'\', tel = \''.$tel.'\', memo = \''.$info["memo"].'\' where id = '.$_GET["id"];

        $result = connect($sql);
    }

?>