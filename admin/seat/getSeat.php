<style>
    .seats-box-body {
        width : 100%;
        height : 100%;
        border : 1px solid black;
        border-radius : 3px;
        background : white;
        text-align : center;
    }  
    .seats-box-content {
        display : inline-block;
        text-align : center;
    }
    .seat {
        margin : 10px;
        display : inline-block;
        width : 40px;
        height : 40px;
    }
    .none {
        border : none;
        display : hidden;
    }
    .empty, .occupy {
        border : 1px solid black;
        border-radius : 3px;
    }
    .empty {
        background : gray;
    }
    .empty:hover {
        background : black;
    }
    .occupy {
        background : red;
    }
</style> 
<?php
    // DB 연결
    require_once('./DataBase/connection.php');
    // require_once('../../DataBase/connection.php');
    $sql = "SELECT * FROM seat";
    $result = connect($sql);

    // 좌표값 배열
    $seat_loc = array();
    while($row = mysqli_fetch_array($result)) {
        $seat_loc[$row['y_location']] = str_split($row['x_location']);
    }

    // 좌석 생성
    $str = "<div class='seats-box-body'><div class='seats-box-content'>";
    for($i = 0; $i < count($seat_loc); $i++) {
        for($j = 0; $j < count($seat_loc[$i+1]); $j++) {
            switch($seat_loc[$i+1][$j]) {
                case 0 : 
                    $str .= "<div class='seat none' data-x='".$j."' data-y='".($i+1)."'><input type='hidden' name='mode' value='none'></div>"; 
                    break;
                case 1 : 
                    $str .= "<div class='seat empty' onclick='selectSeat(".$j.",".($i+1).");' data-x='".$j."' data-y='".($i+1)."'><input type='hidden' name='mode' value='empty'></div>"; 
                    break;
                case 2 : 
                    $str .= "<div class='seat occupy' onclick='cancelSeat(".$j.",".($i+1).");' data-x='".$j."' data-y='".($i+1)."'><input type='hidden' name='mode' value='occupy'></div>"; 
                    break;
            }
        }
        $str .= "<br><br>";
    }
    $str .= "</div></div>";

    echo $str;
?>

<script src="https://code.jquery.com/jquery-3.6.0.js" 
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" 
        crossorigin="anonymous"></script>

<script>
    function selectSeat(x, y) {
        console.log("selectSeat=====");
        $target = $("div[data-x=" + x +"][data-y=" + y + "]");
        $target.removeClass("empty");
        $target.addClass("occupy");
        console.log($target);
    }

    function cancelSeat(x, y) {
        console.log("cancelSeat=====");
        $target = $("div[data-x=" + x +"][data-y=" + y + "]");
        $target.removeClass("occupy");
        $target.addClass("empty");
        console.log($target);
    }
</script>