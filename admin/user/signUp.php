<?php include_once('fncSignUp.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
		<div class="input-form-backgroud row">
			<div class="input-form col-md-12 mx-auto">
				<h4 class="mb-3" style="font-weight: bold; text-align: center;">회원가입</h4>
				<form name="form_userSubmit" action="userSubmit.php" method="POST">
					<input type="hidden" name="checked_id" value=""/>
					<div class="mb-3">
						<label for="id">아이디</label> 
						<div class="row col">
							<input type="text" class="form-control col-6" id="id" name="id" placeholder="아이디를 입력해주세요." value="" required style="width:315px">&nbsp;&nbsp;
							<button type="button" id="btnCheckId" class="btn btn-outline-secondary" onclick="onclickCheckId()">중복확인</button>					
						</div>
					</div>
					<div class="mb-3">
						<label for="password">비밀번호</label> 
						<input type="password" class="form-control" id="password" name="password" placeholder="비밀번호를 입력해주세요" required style="width:315px">
					</div>
					<div class="mb-3">
						<label for="passwordCheck">비밀번호</label> 
						<input type="password" class="form-control" id="passwordCheck" name="passwordCheck" placeholder="비밀번호 확인을 위해 더 입력하세요." required style="width:315px">
					</div>
					<div class="mb-3">
                        <label for="firstName">이름</label> 
                        <input type="text" class="form-control" id="name" name="name" placeholder="이름을 입력해주세요." value="" required style="width:315px">
					</div>
					<div class="mb-3">
						<label for="phone">휴대폰</label>
						<div class="row" style="margin-left: 0px;">
							<div>
								<select id="mobile1" name="mobile1" class="form-control" style="width:100px">
									<option value="010">010</option>
									<option value="011">011</option>
									<option value="016">016</option>
									<option value="017">017</option>
									<option value="018">018</option>
									<option value="019">019</option>
								</select>
							</div>
							<span>-</span>
							<div>
								<input type="text" id="mobile2" name="mobile2" class="form-control" maxlength="4" style="width:100px">
							</div>
							<span>-</span>
							<div>
								<input type="text" id="mobile3" name="mobile3" class="form-control" maxlength="4" style="width:100px">
							</div>
						</div>  
					</div>
					<div class="mb-3">
						<label for="email">이메일</label> 
						<input type="email" class="form-control" id="email" name="email" placeholder="email을 입력해주세요." style="width:315px">&nbsp;&nbsp;
					</div>
					<hr class="mb-4">
					<div class="text-center">
						<button type="button" onclick="cancel()" class="btn btn-secondary btn-lg">취소</button>&nbsp;&nbsp;&nbsp;&nbsp;
						<button type="button" onclick="signUpUser()" class="btn btn-primary btn-lg" value="가입">가입</button>
					</div>
				</form>
			</div>
		</div>
	</div>    
</body>
</html>