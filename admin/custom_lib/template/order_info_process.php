<?php
    require_once($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\DataBase\connection.php');
    
    // CRUD 구분
    $mode = $_GET["mode"];
    // update인 경우
    if($mode === 'update'){
        //TODO 아래 3줄 (7~9) 메소드화 했으면 좋겠음.
        $jsonStr = $_GET["jsonStr"]; // josonStr는 자바스크립트에서 FormData를 JSON.stringify해서 보내온 것.
        $info = json_decode($jsonStr, true); // string -> 객체로 decode. true 옵션을 줘야 select key로 value에 접근 가능.
        $tel = $info["tel1"].'-'.$info["tel2"].'-'.$info["tel3"]; // 디비 테이블에 000-0000-0000 형태로 저장되기 떄문에 새로 조합.
        $sql = 'update item_order_info set name = \''.$info["name"].'\', email = \''.$info["email"].'\', tel = \''.$tel.'\', memo = \''.$info["memo"].'\' where id = '.$_GET["id"];

        $result = connect($sql);

        // alert()처리할 메시지를 response로 반환.
        echo '발주처 정보가 수정되었습니다.';


    //insert인 경우
    }else if($mode === 'insert'){
        $jsonStr = $_GET["jsonStr"];
        $info = json_decode($jsonStr, true);
        $tel = $info["tel1"].'-'.$info["tel2"].'-'.$info["tel3"];

        $sql = 'insert into item_order_info (name, email, tel, memo) values(\''.$info["name"].'\', \''.$info["email"].'\', \''.$tel.'\', \''.$info["memo"].'\')';
        $result = connect($sql);

        echo '발주처가 새로 등록되었습니다.';


    //delete하는 경우
    }else if($mode === 'delete'){
        $sql = 'delete from item_order_info where id = '.$_GET["id"];
        $result = connect($sql);

        echo '삭제되었습니다.';

    // getOrderInfo.php에 있는 기능이긴 함. 
    }else if($mode === 'getOrderInfo'){
        $sql = 'select * from item_order_info where id = '.$_GET["id"];
        $result = connect($sql);
        $arr = '';
        while($order = mysqli_fetch_array($result)){
            $arr = array('name'=> $order["name"], 'tel' => $order["tel"], 'email' => $order["email"], 'memo' => $order["memo"]);
        }
        // javaScript에서 이용할 json객체로 encode. JSON_UNESCAPED_UNICODE옵션 줘야 한글 안깨짐.
        $jsonStr = json_encode($arr, JSON_UNESCAPED_UNICODE);
        echo $jsonStr;
    }

?>