<?php
    require_once('../../DataBase/connection.php');
    $jsonStr = $_GET["data"];
    $arr = json_decode($jsonStr, true);
   
    $type =  $arr["type"];
    $cte_id = $arr["cte_id"];
    $keyword = $arr["keyword"];
    $tag = '';
    $sql = '';   
    if($cte_id === ""){
        $sql = 'select * from v_inventory_info where '.$type.' like \'%'.$keyword.'%\'';
    }else{
        $sql = 'select * from v_inventory_info where category_id = '.$cte_id.' and '.$type.' like \'%'.$keyword.'%\'';
    }

    $result = connect($sql);
    while($item = mysqli_fetch_array($result)){
        $percent = $item["amount"]/50*100;
            $tag = $tag.'<tr>
            <td class="py-1">
              <img class="summary_img" src="'.$item["img_url"].'" alt="image" /> </td>
            <td> '.$item["name"].' </td>
            <td> '.$item["price"].'원 </td>
            <td>
              <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: '.$percent.'%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </td>
            <td> '.$item["order_name"].' </td>
          </tr>';
    }

    echo $tag;
    
?>
