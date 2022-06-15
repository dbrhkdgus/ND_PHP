<?php

    $test = "<script>$('input[name=id]').val();</script>";

    $conn = mysqli_connect('192.168.0.65', 'php', 'php', 'php_project');
    $sql = "
        SELECT id FROM user WHERE id = '$_GET[id]';
    ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    
    if($row == 0){
        echo $_GET['id']."는 사용 가능한 아이디입니다.";
    }else{
        echo $_GET['id']."는 이미 사용중인 아이디입니다.";
    }
    
?>

