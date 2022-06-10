<?php
    require_once('dbconfig.php');


    // 쿼리를 전달하면, 해당 쿼리의 실행 결과를 반환.
    function connect($sql){
        $conn = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_NAME);
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }


    
?>