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
        width : 60px;
        height : 60px;
        border : 1px solid black;
        border-radius : 3px;
        background : white;
    }
</style>

<?php
    // DB 연결
    require_once('./DataBase/connection.php');
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
            $str .= "<div class='seat' data-x='".$seat_loc[$i+1][$j]."' data-y='".($i+1)."'></div>";
        }
        $str .= "<br><br>";
    }
    $str .= "</div></div>";

    echo $str;
?>