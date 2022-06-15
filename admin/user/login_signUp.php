<form name="form_login" method="POST">
    <label for="">ID : <input type="text" class="form-control" id="id" name="id" value="" required></label>
    <label for="">PW : <input type="password" class="form-control" id="password" name="password"></label>
</form>
<button type="button" onclick="login()" class="btn btn-secondary btn-lg">로그인</button>&nbsp;&nbsp;&nbsp;&nbsp;
<button type="button" onclick="window.open('admin/user/signUp.php', 'window_name','width=430, height=680, location=no, status=no, scrollbars=yes')" class="btn btn-primary btn-lg">회원가입</button> 
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
    function login(){
        var id = $("#id").val();
        var password = $("#password").val();
        if(id == ''){
            alert("아이디가 입력되지 않았습니다.");
            $("#id").focus();
            return;
        }
        if(password == ''){
            alert("비밀번호가 입력되지 않았습니다.");
            $("#password").focus();
            return;
        }
        var loginForm = document.form_login;
        var url = "admin/user/login.php"
        window.open("", "form_login", "toolbar=no, width=480, height=120");
        loginForm.action = url;
        loginForm.method = "POST";
        loginForm.target = "form_login";
        var result = loginForm.submit();
    }
</script>