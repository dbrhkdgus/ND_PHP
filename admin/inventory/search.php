<?php
    require_once('../../DataBase/connection.php');
    // form data 받아옴.
    $jsonStr = $_GET["data"];
    $arr = json_decode($jsonStr, true); //json_decode, true해야 select key로 value접근 가능.
   
    $type =  $arr["type"];
    $cte_id = $arr["cte_id"];
    $keyword = $arr["keyword"];
    $tag = '검색 결과 없음'; // 검색 결과가 없을 경우 반환할 template. 별도로 안꾸미고 한줄만 출력. <~ 꾸미려면 이 지점에 tag를 넣으면 댐.
    $sql = '';   
    
    if($cte_id === ""){ // 카테고리를 선택하고 검색하는 경우.
        $sql = 'select * from v_inventory_info where '.$type.' like \'%'.$keyword.'%\' order by category_id';
    }else{ // 카테고리 선택없이 검색한는 경우.
        $sql = 'select * from v_inventory_info where category_id = '.$cte_id.' and '.$type.' like \'%'.$keyword.'%\' order by category_id';
    }

    $result = connect($sql);
    // 쿼리 조회 결과 순환
    while($item = mysqli_fetch_array($result)){
        $percent = $item["amount"]/$item["max_amt"]*100; // progressbar에 처리할 값.
        $tag = $tag.'<tr>
        <td class="py-1">
          <img class="summary_img" src="'.$item["img_url"].'" alt="image" /> </td>
        <td> '.$item["name"].' </td>
        <td> '.$item["price"].'원 </td>
        <td> '.$item["category_name"].' </td>
        <td>
          <div class="progress">
            <div class="progress-bar bg-success" role="progressbar" style="width: '.$percent.'%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </td>
        <td> '.$item["order_name"].' </td>
        <td><button onClick = "itemDetail('.$item["id"].')">상세 보기</button> </td>
      </tr>';
    }
    // 검색 결과 태그 반환
    echo $tag;

    
?>
