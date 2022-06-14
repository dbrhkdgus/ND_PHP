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

    function getOrderList(){
        $sql = 'select * from item_order_info order by id';
        $result = connect($sql);
        $tag = '';

        while($order = mysqli_fetch_array($result)){
            $tag = $tag.'<tr>
            <td> '.$order["name"].' </td>
            <td> '.$order["email"].'원 </td>
            <td> '.$order["tel"].' </td>
            <td><button onClick = "orderUpdate('.$order["id"].')">정보 수정</button> </td>
            <td><button onClick = "orderDelete('.$order["id"].')">삭  제</button> </td>
          </tr>';
        }
        $tag = $tag.'<tr><td id="last_td" colspan="5"><button onClick="addOrderInfo();">발주처 추가</button></td></tr>';
        return $tag;
    }
?>