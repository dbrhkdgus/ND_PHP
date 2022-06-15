<?php
    $conn = mysqli_connect('192.168.0.65', 'php', 'php', 'php_project');
    $filtered = array(
        'id' => mysqli_real_escape_string($conn, $_POST['id']),
        'password' => mysqli_real_escape_string($conn, $_POST['password'])
    );

    $sql = "
        SELECT * FROM user WHERE id = '$_POST[id]' AND password = '$_POST[password]'
    ";
    $result = mysqli_query($conn,$sql);
    $user = mysqli_fetch_array($result);
    
    if($user == 0){
        $sql = "
            SELECT * FROM user WHERE id = '$_POST[id]'
        ";
        $result = mysqli_query($conn,$sql);
        $passChack = mysqli_fetch_array($result);
        if($passChack != $_POST['password']){
            echo "1";
        }
    }else{
        session_start();
        $_SESSION['id'] = $_POST['id'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['user'] = $user;
        $json = json_encode(array('userNo' => $user['userNo'], 'id' => $user['id'], 'password' => $user['password'],
                                  'phone' => $user['phone'], 'email' => $user['email'], 'role' => $user['role']));
        echo($json);
    }
?>


