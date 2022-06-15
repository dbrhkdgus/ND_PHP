<?php
    require_once($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\DataBase\connection.php');

    $id = $_POST["id"];
    $mode = $_POST["mode"];
    $jsonStr = $_POST["jsonStr"];
    $item = json_decode($jsonStr, true);

    if($mode === 'update'){

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

        echo '제품 정보가 수정되었습니다.';
    }else if($mode === 'insert'){
        if(!isset($item["is_pop"])){
            $item["is_pop"] = 0;
        }
        if(!isset($item["is_new"])){
            $item["is_new"] = 0;
        }
        if(!isset($item["auto_email"])){
            $item["auto_email"] = 0;
        }

        $sql = 'insert into inventory set name = \''.$item["name"].'\', price = '.$item["price"].', amount = '.$item["amount"].', maint_amt = '.$item["maint_amt"].', max_amt = '.$item["max_amt"].', auto_email = '.$item["auto_email"].', is_new = '.$item["is_new"].', is_pop = '.$item["is_pop"].', img_url = \''.$item["img_url"].'\'';
        $id = connect_getId($sql);

        $sql = 'insert into rel_inventory_category set inventroy_id = '.$id.', category_id = '.$item["cte_id"];
        $result = connect($sql);

        $sql = 'insert into rel_inventory_order set inventory_id = '.$id.', order_info_id = '.$item["order_info_id"];
        $result = connect($sql);

        echo $id;
    }else if($mode === 'delete'){
        $sql = 'delete from inventory where id = '.$id;
        $result = connect($sql);
        echo '삭제되었습니다.';
    };

?>