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
        $sql = 'select * from item_category order by id';
        $result = connect($sql);

        
    }
?>