<?php
    require_once($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\DataBase\connection.php');
    $mode = $_POST["mode"];

    if($mode === 'update'){
        $id = $_POST["id"];
        $name = $_POST["name"];
        $sql = 'update item_category set name = \''.$name.'\' where id = '.$id;
        $result = connect($sql);



    }else if($mode === 'insert'){
        $name = $_POST["name"];
        $sql = 'insert into item_category(name) values(\''.$name.'\')';

        $result = connect($sql);
        echo $result;

    }else if($mode === 'delete'){
        $sql = 'delete from item_category where id = '.$_POST["id"];
        $result = connect($sql);
    }
    

?>