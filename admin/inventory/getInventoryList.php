<?php
    function allItems(){
        $sql = 'select * from v_inventory_info order by category_id';
        $result = connect($sql);
        $tag = '';
        while($item = mysqli_fetch_array($result)){
            $percent = $item["amount"]/$item["max_amt"]*100;
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

        echo $tag;
    }

?>
