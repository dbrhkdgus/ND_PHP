<?php
    require_once('../../DataBase/connection.php');
    $sql = 'select * from item_category order by id';
    $result = connect($sql);

    $tag = '';
    while($cte = mysqli_fetch_array($result)){
        $tag = $tag.'<option value ="'.$cte["id"].'">'.$cte["name"].'</option>';
    }

    echo $tag;
    
?>
