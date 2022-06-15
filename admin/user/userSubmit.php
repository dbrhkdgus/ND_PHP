<?php
    $conn = mysqli_connect('192.168.0.65', 'php', 'php', 'php_project');
    
    $phone = "$_POST[mobile1]"."-"."$_POST[mobile2]"."-"."$_POST[mobile3]";
    $sql = "
        INSERT INTO user
        (id, password, name, phone, email)
        VALUES(
            '{$_POST['id']}',
            '{$_POST['password']}',
            '{$_POST['name']}',
            '$phone',
            '{$_POST['email']}'
        )
    ";
    $result = mysqli_query($conn,$sql);
    if($result == false){        
?>
    <script>
        alert("회원가입에 실패하였습니다.");
        window.open('admin/user/signUp.php', 'window_name','width=430, height=680, location=no, status=no, scrollbars=yes');
    </script>
<?php
    }else{
?>
    <script>
        alert("회원가입에 완료하였습니다.");
        window.close();
    </script>
<?php        
    }

?>