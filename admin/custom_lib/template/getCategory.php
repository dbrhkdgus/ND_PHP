<?php
    require_once($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\DataBase\connection.php');

    // 카테고리 옵션태그 template 반환 함수
    function getCteOptionTag($id = 0){
        $sql = 'select * from item_category order by id';
        $result = connect($sql); // 쿼리 결과 저장.

        $tag = '';
        // 각 결과값에 대해 value는 id값인 option 태그 작성
        while($cte = mysqli_fetch_array($result)){
            $tag = $tag.'<option value ="'.$cte["id"].'"';

            // 전달된 id값이, 쿼리 결과값의 id와 일치하는 경우 selected 처리
            if($cte["id"] == $id){
                $tag = $tag.' selected';
            }
            $tag = $tag.'>'.$cte["name"].'</option>';
        }
        
        return $tag;
    }

    // 카테고리 리스트 template 반환 함수
    function getCteListTag(){
        $sql = 'SELECT a.*, COUNT(b.category_id) as count FROM item_category a left JOIN  v_inventory_info b ON b.category_id = a.id GROUP BY a.id ORDER BY a.id';
        $result = connect($sql);
        
        $tag = '';
        while($cte = mysqli_fetch_array($result)){

            $tag = $tag.'<tr>
            <input type="hidden" id="isChanged-'.$cte["id"].'" name="isChanged" value="false">
            <td> <input type="text" id="cte_name-'.$cte["id"].'" value="'.$cte["name"].'" onChange="is_changed('.$cte["id"].');"> </td>
            <td> '.$cte["count"].'개 </td>
            <td><button onClick = "updateCte('.$cte["id"].')">수정하기</button> </td>
            <td><button onClick = "deleteCte('.$cte["id"].', '.$cte["count"].')">삭제하기</button> </td>
            </tr>';

        }
        $tag = $tag.'<tr><td id="last_td" colspan="4"><button onClick="addCte();">카테고리 추가</button></td></tr>';
        return $tag;
    }
?>