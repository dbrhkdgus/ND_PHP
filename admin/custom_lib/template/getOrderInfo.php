<?php
    require_once($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\DataBase\connection.php');

    // 발주처 정보 반환 함수
    function getOrderInfo($id = 0){ // 매개변수로 발주처 id 받음. 넘기지 않는 경우 0처리
        $sql = 'select * from item_order_info';

        // id를 넘긴 경우에만 쿼리문에 where 조건 
        if($id != 0){
            $sql = $sql.' where id = '.$id;
        }

        $result = connect($sql);
        $arr = ''; // 조회 결과를 배열구조로 담는다.
        while($order = mysqli_fetch_array($result)){
            // 조회결과를 배열에 저장. 
            $arr = array('name'=> $order["name"], 'tel' => $order["tel"], 'email' => $order["email"], 'memo' => $order["memo"]);
        }      

        // 배열 반환. 이후 select key값으로 value 찾을 수 잇음.
        return $arr;
    }

    // 발주처 리스트 template 반환 함수
    function getOrderList(){
        $sql = 'select * from item_order_info order by id'; // 발주처 전체 조회 쿼리
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

    // select 태그 template 반환 함수.
    function getOrderSelectTag($id){
        $sql = 'select * from item_order_info order by id';
        $result = connect($sql);
        $tag = '<select name="order_info_id" onChange="getOrderInfo(\'t\');">
                    <option value="0">발주처를 선택하세요.</option>';
        
        while($order = mysqli_fetch_array($result)){
            $tag = $tag.'<option value="'.$order["id"].'"';
            // 쿼리 실행결과로 받아온 발주처id와 매개변수로 받은 id가 일치할 때 selected 추가
            if($id === $order["id"]){
                $tag = $tag.' selected';
            }
            
            $tag = $tag.'>'.$order["name"].'</option>';
        }

        $tag = $tag.'</select>';

        return $tag;
    }
?>