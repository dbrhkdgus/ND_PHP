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
        $.ajax({
            url : "admin/user/login.php",
            type : "POST",
            data : $("form[name='form_login']").serialize(),
        }).done(function(data){			
            if(data == 1){
                alert("비밀번호가 맞지 않습니다.");
            }else{
                data = JSON.parse(data);
                if(data.role == "0"){
                    alert("여기는 관리자");
                }else if(data.role == "1" || data.role == "2"){
                    alert("여기는 회원과 비회원");
                }
            }
            
		});
    }
</script>