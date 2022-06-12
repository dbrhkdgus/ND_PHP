<?php
    // DB 연결
    require_once('../DataBase/connection.php');

    // DB에 저장된 좌석 정보 불러오기
    $sql = "SELECT * FROM tb_seat";
    $result = connect($sql);

    // x좌표 배열로

    // y좌표, x좌표 이중 for문
    // 0일 경우 좌석없음, 1일 경우 빈좌석, 2일 경우 있는 좌석
?>