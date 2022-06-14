<?php
    require_once($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\DataBase\connection.php');
    function getCteOptionTag($id = 0){
        $sql = 'select * from item_category order by id';
        $result = connect($sql);

        $tag = '';
        while($cte = mysqli_fetch_array($result)){
            $tag = $tag.'<option value ="'.$cte["id"].'"';

            if($cte["id"] == $id){
                $tag = $tag.' selected';
            }
            $tag = $tag.'>'.$cte["name"].'</option>';
        }
        
        return $tag;
    }

    function getCteListTag(){
        $sql = 'SELECT b.*, COUNT(a.category_id) as count FROM v_inventory_info a RIGHT JOIN  item_category b ON a.category_id = b.id GROUP BY a.category_id order by b.id';
        $result = connect($sql);

        $tag = '';
        while($cte = mysqli_fetch_array($result)){

            $tag = $tag.'<tr>
            <input type="hidden" id="isChanged-'.$cte["id"].'" name="isChanged" value="false">
            <td> <input type="text" id="cte_name-'.$cte["id"].'" value="'.$cte["name"].'" onChange="is_changed('.$cte["id"].');"> </td>
            <td> '.$cte["count"].'개 </td>
            <td><button onClick = "updateCte('.$cte["id"].')">수정하기</button> </td>
            <td><button onClick = "deleteCte('.$cte["id"].')">삭제하기</button> </td>
            </tr>';

        }
        $tag = $tag.'<tr><td id="last_tr" colspan="4"><button onClick="addCte();">카테고리 추가</button></td></tr>';
        return $tag;
    }
?>