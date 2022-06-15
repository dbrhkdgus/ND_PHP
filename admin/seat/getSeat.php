<?php
    // 사용자 화면
    function getSeatToMain() {
        // DB 연결
        require_once($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\DataBase\connection.php');
        $sql = "SELECT * FROM seat";
        $result = connect($sql);
        
        // 좌표값 배열
        $seat_loc = array();
        while($row = mysqli_fetch_array($result)) {
            $seat_loc[$row['y_location']] = str_split($row['x_location']);
        }

        // 좌석 생성
        $str = "";
        for($i = 0; $i < count($seat_loc); $i++) {
            for($j = 0; $j < count($seat_loc[$i+1]); $j++) {
                switch($seat_loc[$i+1][$j]) {
                    case 0 : 
                        $str .= "<div class='seat none' data-x='".$j."' data-y='".($i+1)."'></div>"; 
                        break;
                    case 1 : 
                        $str .= "<div class='seat empty' onclick='selectSeat(".$j.",".($i+1).");' data-x='".$j."' data-y='".($i+1)."'></div>"; 
                        break;
                    case 2 : 
                        $str .= "<div class='seat occupy' data-x='".$j."' data-y='".($i+1)."'></div>"; 
                        break;
                }
            }
            $str .= "<br><br>";
        }
        echo $str;
    }

    // 관리자 화면
    function getSeatToAdmin() {
        // DB 연결
        require_once($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\DataBase\connection.php');
        $sql = "SELECT * FROM seat";
        $result = connect($sql);

        // 좌표값 배열
        $seat_loc = array();
        while($row = mysqli_fetch_array($result)) {
            $seat_loc[$row['y_location']] = str_split($row['x_location']);
        }

        // 좌석 생성
        $str = "";
        for($i = 0; $i < count($seat_loc); $i++) {
            for($j = 0; $j < count($seat_loc[$i+1]); $j++) {
                $str .= "<div ";
                switch($seat_loc[$i+1][$j]) {
                    case 0 : 
                        $str .= "class='seat none' "; 
                        break;
                    case 1 : 
                        $str .= "class='seat empty' "; 
                        break;
                    case 2 : 
                        $str .= "class='seat occupy' "; 
                        break;
                }
                $str .= "onclick='checkSeat(".$j.",".($i+1).");' data-x='".$j."' data-y='".($i+1)."'></div>";
            }
            $str .= "<br><br>";
        }
        echo $str;
    }
?>