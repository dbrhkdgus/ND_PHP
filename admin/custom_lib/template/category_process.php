<?php
    require_once($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\DataBase\connection.php');
    $mode = $_GET["mode"];
    if($mode === 'update'){
        $id = $_GET["id"];
        $name = $_GET["name"];
        $sql = 'update item_category set name = \''.$name.'\' where id = '.$id;
        $result = connect($sql);
    }
    

?>