<?php
    require_once($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\DataBase\connection.php');
    include('./getCategory.php');
    include('./getOrderInfo.php');

    // 어떤 모달창 template가 필요한지 구분
    $mode = $_GET["mode"];

    // 제품 등록하기 modal template
    if($mode === 'item_default'){
     
      $tag = '<form name="inventory_detail" onSubmit="return false"><input type="hidden" name="isChanged" value="false">
      <!-- 카테고리 -->
      <hr style="margin-bottom : 0px;">
      <div class="category_info">
        <label for="cte_select"> 카테고리 : 
          <select name="cte_id" id="cte_select" onChange="is_changed();">
          '.getCteOptionTag().'
          </select>
        </label>
      </div>
      <hr style="margin-top : 0px;">

      <!-- 아이템 기본 정보 -->
      <h4>제품 정보</h4>
      <div class="basic_info_box">
        <div class="item_img_box">
          <input type="hidden" name="img_url" value="">
          <img id="modal_img" class="summary_img" src="../img/default_picture.png" alt="">
          <input type="file" name="img" accept="image/*" style="display:none;" onChange="img_change(event);">
          <button onClick="btn_img_change()">사진 수정</button>
        </div>
        <div class="item_info_table">
          <table style="width: 120%;">
          <tr>
            <th> 이름 </th>
            <td><input type="text" name="name" value="" onChange="is_changed(\'insert\');"></td>
          </tr>
          <tr>
            <th> 가격 </th>
            <td><input type="number" name="price" value="" onChange="is_changed(\'insert\');">원</td>
          </tr>
          <tr>
            <th> 현재 재고량 </th>
            <td><input type="number" name="amount" value="" onChange="is_changed(\'insert\');">개</td>
          </tr>
          <tr>
            <th> 최소 재고량 </th>
            <td><input type="number" name="maint_amt" value="" onChange="is_changed(\'insert\');">개</td>
          </tr>
          <tr>
            <th> 최대 재고량 </th>
            <td><input type="number" name="max_amt" value="" onChange="is_changed(\'insert\');">개</td>
          </tr>
          <tr>
            <th> 인기/신제품 </th>
            <td>
              <input style="width: 10%;" type="checkbox" name="is_new" value="1" onChange="is_changed(\'insert\');"> 신제품
              <input style="width: 10%;" type="checkbox" name="is_pop" value="1" onChange="is_changed(\'insert\');"> 인기
            </td>
          </tr>
          <tr>
            <th> 자동 발주 </th>
            <td>
            <p style="font-size : 10px; margin-bottom:0px; margin-top: 2px;">최소 재고 도달 시 자동 발주</p>
            <input style="width: 10%;" name="auto_email" type="checkbox" value="1" onChange="is_changed(\'insert\');"> 자동발주
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
                <td>'.getOrderSelectTag(0).'</td>
              </tr>
              <tr>
                <th> 발주처 연락처 </th>
                <td><span id="order_info_tel"></span></td>
              </tr>
              <tr>
                <th> 발주처 이메일 </th>
                <td><span id="order_info_email"></span></td>
              </tr>
              <tr>
                <th> 메모 </th>
                <td><textarea name="" id="" cols="25" rows="5" style="resize:none;" readonly></textarea></td>
              </tr>
            </tbody>
          </table>
        </div>
        <hr style="margin-bottom: 10px;">
        <div class="submit_button">
          <button id="btn_item_detail_submit" onClick="inventory_process(\'insert\', 0)">닫기</button>
        </div>';

    echo $tag;

  // 제품 상세보기 modal template
  }else if($mode === 'item_detail'){
      
      $tag = '<form name="inventory_detail" onSubmit="return false"><input type="hidden" name="isChanged" value="false">';
      $id = $_GET["id"];
      
      $sql = 'select * from v_inventory_info where id ='.$id;
      // 제품 id를 이용하여 특정 제품 조회
      $result = connect($sql);

      // 각 태그의 value값 채워서 반환
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
            <img id="modal_img" class="summary_img" src="'.$item["img_url"].'" alt="">
            <input type="file" name="img" accept="image/*" style="display:none;" onChange="img_change(event);">
            <button onClick="btn_img_change()">사진 수정</button>
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
              <th> 현재 재고량 </th>
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
                  <td>'.getOrderSelectTag($item["order_id"]).'</td>
                </tr>
                <tr>
                  <th> 발주처 연락처 </th>
                  <td><span id="order_info_tel"></span></td>
                </tr>
                <tr>
                  <th> 발주처 이메일 </th>
                  <td><span id="order_info_email"></span></td>
                </tr>
                <tr>
                  <th> 메모 </th>
                  <td><textarea name="" id="" cols="25" rows="5" style="resize:none;" readonly></textarea></td>
                </tr>
              </tbody>
            </table>
          </div>
          <hr style="margin-bottom: 10px;">
          <div class="submit_button">
            <button id="btn_item_delete" onClick="inventory_process(\'delete\', '.$item["id"].');">삭제</button>
            <button id="btn_item_detail_submit" onClick="inventory_process(\'update\', '.$item["id"].');">닫기</button>
          </div>';
        }
      echo $tag;

    // 발주처 상세보기 modal template
    }else if($mode === 'order_info'){
      $id = $_GET["id"];
      $order = getOrderInfo($id);
      $tel_arr = explode('-',$order["tel"]); // 디비 테이블에 000-0000-0000의 형식으로 저장되어 있으므로
                                             // explode하여 배열로 담는다. 
                                             // 000-0000-0000 => [000, 0000, 0000]. 각 인덱스로 접근 가능.

      $tag = '<hr>
            <div class="order_info_form_box">
                <form name="order_info_form" onSubmit="return false">
                    <input type="hidden" name="isChanged" value="false">
                    <label for="">
                        <p>발주처 : </p><input type="text" name="name" value="'.$order["name"].'" onChange="is_change(\'update\');">
                    </label>
                    <label for="">
                        <p>Email : </p><input type="email" name="email" value="'.$order["email"].'" onChange="is_change(\'update\');">
                    </label>
                    <label for="">
                        <p>전화번호 : </p><input class="tel_input valid" type="text" name="tel1" value="'.$tel_arr[0].'" onChange="is_change(\'update\');"> - <input class="tel_input valid" type="text" name="tel2" value="'.$tel_arr[1].'" onChange="is_change(\'update\');"> - <input class="tel_input valid" type="text" name="tel3" value="'.$tel_arr[2].'" onChange="is_change(\'update\');">
                    </label>
                    <label for="">
                        <p>메모 : </p> <textarea name="memo" cols="30" rows="10" onChange="is_change(\'update\');">'.$order["memo"].'</textarea>
                    </label>
                    
                </form>
            </div>
            <hr>
            <div class="order_btn_box">
                <button id="btn_update_order_info" onClick="order_info_process(\'update\','.$id.');">닫기</button>
            </div>';
      echo $tag;   
    }

?>