<?php
    require_once('./DataBase/connection.php');
    $conn = mysqli_connect('192.168.0.65', 'php', 'php', 'php_project');
    function login(){

        $sql = "SELECT * FROM user WHERE id = ''";
    }
?>
<form action="">
    <label for="">ID : <input type="text" class="form-control" id="id" name="id" value="" required></label>
    <label for="">PW : <input type="password" class="form-control" id="password" name="password"></label>
</form>
<button type="button" onclick="login()" class="btn btn-secondary btn-lg">로그인</button>&nbsp;&nbsp;&nbsp;&nbsp;
<button type="button" onclick="window.open('admin/user/signUp.php', 'window_name','width=430, height=680, location=no, status=no, scrollbars=yes')" class="btn btn-primary btn-lg">회원가입</button> 