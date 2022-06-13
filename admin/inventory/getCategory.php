<?php
    require_once('../../DataBase/connection.php');
    function getCteOptionTag(){
        $sql = 'select * from item_category order by id';
        $result = connect($sql);
        $id = '';

        if(isset($_GET["id"])){$id = $_GET["id"];}
        
        $tag = '';
        while($cte = mysqli_fetch_array($result)){
            $tag = $tag.'<option value ="'.$cte["id"];
            if($cte["id"] == $id){
                $tag = $tag.' selected';
            }
            $tag = $tag.'">'.$cte["name"].'</option>';
        }
        
        return $tag;
    }
        
?>
