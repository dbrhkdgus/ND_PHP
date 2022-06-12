<?php 
    require_once('./DataBase/connection.php');
    function getItemByCategoryId($id){
        $sql = 'select * from v_inventory_info where category_id ='.$id;
        
        return connect($sql);
    }
    
    $category = connect('SELECT * FROM item_category');


    $tag = '';

    while($cte = mysqli_fetch_array($category)){
        $tag = $tag.'<div class="item_category" id="ct'.$cte["id"].'"><h2>'.$cte["name"].'</h2><div class="food-item-box">';
        $items = getItemByCategoryId($cte["id"]);
        while($item = mysqli_fetch_array($items)){
            $tag = $tag.' <div class="food-item">
                <img src="'.$item["img_url"].'" alt="">
                <p>'.$item["name"].' : '.$item["price"].'원</p>
            </div>';
        }
        
    
        $tag = $tag.'</div></div>';
    }


    echo $tag;
?>

