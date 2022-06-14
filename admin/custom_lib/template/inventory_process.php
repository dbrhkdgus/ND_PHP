<?php
    require_once($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\DataBase\connection.php');

    $id = $_POST["id"];
    $mode = $_POST["mode"];
    $jsonStr = $_POST["jsonStr"];
    $item = json_decode($jsonStr, true);
    if($mode === 'update'){

        $item = json_decode($jsonStr, true);
        if(!isset($item["is_pop"])){
            $item["is_pop"] = 0;
        }
        if(!isset($item["is_new"])){
            $item["is_new"] = 0;
        }
        if(!isset($item["auto_email"])){
            $item["auto_email"] = 0;
        }
        
        $sql = 'update inventory set name = \''.$item["name"].'\', price = '.$item["price"].', amount = '.$item["amount"].', maint_amt = '.$item["maint_amt"].', max_amt = '.$item["max_amt"].', auto_email = '.$item["auto_email"].', is_new = '.$item["is_new"].', is_pop = '.$item["is_pop"].', img_url = \''.$item["img_url"].'\' where id = '.$id; 
        $result = connect($sql);

        $sql = 'update rel_inventory_category set category_id = '.str_replace('selected','',$item["cte_id"]).' where inventroy_id = '.$id;
        $result = connect($sql);
    };

?>