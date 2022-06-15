<?php
    $conn = mysqli_connect('192.168.0.65', 'php', 'php', 'php_project');
    $sql = "
        SELECT id FROM user WHERE id = '$_GET[id]';
    ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    
    if($row == 0){
        echo "<script>alert('".$_GET['id']."는 사용 가능한 아이디입니다.')</script>";
?>
        <script>
            window.close();
        </script>
<?php
    }else{
        echo "<script>alert('".$_GET['id']."는 중복된 아이디입니다.')</script>";
?>
        <script>
            window.close();
        </script>
<?php   
    }
?>
