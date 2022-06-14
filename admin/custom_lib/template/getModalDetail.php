<?php
    require_once($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\DataBase\connection.php');
    include('./getCategory.php');
    include('./getOrderInfo.php');
    $mode = $_GET["mode"];
    if($mode === 'item'){
      
      $tag = '<form name="inventory_detail" onSubmit="return false"><input type="hidden" name="isChanged" value="false">';
      $id = $_GET["id"];
      
      $sql = 'select * from v_inventory_info where id ='.$id;
      
      $result = connect($sql);
      
      while($item = mysqli_fetch_array($result)){
        $order = getOrderInfo($item["order_id"]);
        $tag = $tag.'<!-- 카테고리 -->
        <hr style="margin-bottom : 0px;">
        <div class="category_info">
          <label for="cte_select"> 카테고리 : 
            <select name="cte_id" id="cte_select" onChange="is_changed();">
            '.getCteOptionTag($item["category_id"]).'
            </select>
          </label>
        </div>
        <hr style="margin-top : 0px;">

        <!-- 아이템 기본 정보 -->
        <h4>제품 정보</h4>
        <div class="basic_info_box">
          <div class="item_img_box">
            <input type="hidden" name="img_url" value="'.$item["img_url"].'">
            <img class="summary_img" src="'.$item["img_url"].'" alt="">
            <button onClick="img_change()">사진 수정</button>
          </div>
          <div class="item_info_table">
            <table style="width: 120%;">
            <tr>
              <th> 이름 </th>
              <td><input type="text" name="name" value="'.$item["name"].'" onChange="is_changed();"></td>
            </tr>
            <tr>
              <th> 가격 </th>
              <td><input type="number" name="price" value="'.$item["price"].'" onChange="is_changed();">원</td>
            </tr>
            <tr>
              <th> 재고량 </th>
              <td><input type="number" name="amount" value="'.$item["amount"].'" onChange="is_changed();">개</td>
            </tr>
            <tr>
              <th> 최소 재고량 </th>
              <td><input type="number" name="maint_amt" value="'.$item["maint_amt"].'" onChange="is_changed();">개</td>
            </tr>
            <tr>
              <th> 최대 재고량 </th>
              <td><input type="number" name="max_amt" value="'.$item["max_amt"].'" onChange="is_changed();">개</td>
            </tr>
            <tr>
              <th> 인기/신제품 </th>
              <td>
                <input style="width: 10%;" type="checkbox" name="is_new" value="1"';
                if($item["is_new"]){
                  $tag = $tag.' checked';
                }

                $tag = $tag.' onChange="is_changed();"> 신제품
                <input style="width: 10%;" type="checkbox" name="is_pop" value="1"';
                if($item["is_pop"]){
                  $tag = $tag.' checked';
                }          

                $tag = $tag.' onChange="is_changed();"> 인기
              </td>
            </tr>
            <tr>
              <th> 자동 발주 </th>
              <td>
              <p style="font-size : 10px; margin-bottom:0px; margin-top: 2px;">최소 재고 도달 시 자동 발주</p>
              <input style="width: 10%;" name="auto_email" type="checkbox" value="1"';
              if($item["auto_email"]){
                $tag = $tag.' checked';
              }

              $tag = $tag.' onChange="is_changed();"> 자동발주
              </td>
            </tr>
            </table>
          </div>
        </div></form>
          <!-- 아이템 기본 정보 끝 -->
          <hr>
          <!-- 발주 관리 -->
          <div class="item_order">
            <h4>발주 관리</h4>
            <table style="width: 100%;">
              <tbody>
                <tr>
                  <th>발주처 명</th>
                  <td> '.$item["order_name"].' </td>
                </tr>
                <tr>
                  <th> 발주처 연락처 </th>
                  <td> '.$order["tel"].' </td>
                </tr>
                <tr>
                  <th> 발주처 이메일 </th>
                  <td> '.$order["email"].' </td>
                </tr>
                <tr>
                  <th> 메모 </th>
                  <td><textarea name="" id="" cols="25" rows="5" style="resize:none;" readonly>'.$order["memo"].'</textarea></td>
                </tr>
              </tbody>
            </table>
          </div>
          <hr style="margin-bottom: 10px;">
          <div class="submit_button">
            <button id="btn_item_detail_submit" onClick="inventory_process(\'update\', '.$item["id"].')">닫기</button>
          </div>';
        }
      echo $tag;
    }

?>