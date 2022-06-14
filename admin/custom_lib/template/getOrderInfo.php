<?php
    require_once($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\DataBase\connection.php');
    function getOrderInfo($id = 0){
        $sql = 'select * from item_order_info';

        if($id != 0){
            $sql = $sql.' where id = '.$id;
        }

        $result = connect($sql);
        $arr = '';
        while($order = mysqli_fetch_array($result)){
            $arr = array('name'=> $order["name"], 'tel' => $order["tel"], 'email' => $order["email"], 'memo' => $order["memo"]);
        }      

        return $arr;
    }
?>