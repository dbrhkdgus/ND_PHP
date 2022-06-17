<?php require_once('../../header.php') ?>
<?php include('../email_process.php') ?>
<link rel="stylesheet" href="../../custom_lib/css/modal.css">
<link rel="stylesheet" href="../css/email_setting.css">
<section id="main-content">
    <section class="wrapper">
    <?php include('../../custom_lib/template/search_form.php') ?>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card" style="box-shadow: 0 0 0; height : 100%;">
                <div class="card-body">
                    <h4 class="card-title" onClick="location.reload()" style="cursor : pointer;"> 이메일 양식 설정 </h4>
                    <form name="email_form" onsubmit="return false">
                        <div class="email_setting_box">
                            <label for="">
                                <p>보내는 주소  </p><input type="email" name="address" value="<?= getEmailInfo()['address']; ?>" >
                                <button onclick="$('.modal').show();">기본 이메일 주소 변경</button>
                            </label>
                            <div class="form_handling_box">
                            <label>
                                <p>자동 전송 양식</p><input type="checkbox" name="auto" value="auto" checked>
                            </label>
                            <label >
                                <p style="margin-left : 1%;">일반 메일 전송</p><input type="checkbox" name="auto" value="manual">
                            </label>
                        </div>
                        <label id="receiver_label"  for="">
                            <p>받는 주소  </p><input type="email" name="receiver" value="" >
                        </label>
                        <label for="">
                            <p>제목  </p><input type="text" name="title" value="<?= getEmailInfo()['title']; ?>" onChange="">
                        </label>
                        <textarea name="content" id="" cols="30" rows="20"><?php echo getEmailForm(); ?></textarea>
                        <button id="btn_email_submit" onClick="mail_process();">저장</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- 모달창 -->
    </section>
        <div class="modal" id="email_info_modal">
            <div class="modal_body" style="height:200px">email 설정 변경
                <div class="close_modal" onClick="close_modal(this);">x</div>
                <hr>
                    <div class="email_info_box">
                        <label for=""> 메일주소 : 
                            <input type="text" name="address" value="<?= getEmailInfo()['address']; ?>">
                        </label>
                        <label for=""> 비밀번호 : 
                            <input type="password"  name="pw" value="">
                        </label>
                    </div>
                    <button onClick="updateEmailInfo();">등록하기</button>        
            </div>
        </div>
    
</section>
<script src="../../custom_lib/js/common.js"></script>

<!-- $(document).ready() 때문에 src가 안먹음.. 걍 냅두면 작동됨. -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
    $("input[name=auto]").click(function(){
        // 체크박스가 radio처럼 작동되도록 함
        if($(this).prop('checked')){ 
            $("input[name=auto]").prop('checked', false); // 동일한 name값의 input[type=checkbox]를 모두 checked = false 시킴.
            $(this).prop('checked',true); // event가 발생한 태그만 checked = true 처리
        }
        if($(this).val() === 'auto'){ // 자동 메일 발송을 선택한 경우, 해당 양식을 출력
            $('input[name=title]').val('<?= getEmailInfo()["title"] ?>');
            $('textarea').val(`<?php echo getEmailForm(); ?>`);
            $('#btn_email_submit').text('저장');
            $("#receiver_label").hide();
        }else if($(this).val() === 'manual'){ // 수동 메일 보내기를 선택한 경우, 빈 값으로 남김.
            $('input[name=title]').val('');
            $('textarea').val('');
            $('#btn_email_submit').text('발송');
            $("input[name=receiver").val('');
            $("#receiver_label").show();
        }
    }) 
});

// 메일 보내기 함수.
function mail_process(){
  
  // form -> FormData -> jsonStr
  var form = $(document['email_form']);
  var formData = new FormData(form[0]);
  var obj = {};
  for(const [k, v] of formData){
    obj[k] = v;
  };

  const jsonStr = JSON.stringify(obj);
  
  $.ajax({
      url : '<?= PATH ?>/email/email_process.php',
      method : 'post',
      data : {
          jsonStr : jsonStr
      },
      success(res){ // response되는 값이 엄청 긺. PHPMailer가 자동으로 처리 결과 전체를 리턴.. 
        console.log(res.slice(-1));
        var flag = res.slice(-1); // 다만 마지막 한글자를 추가해서 그 값만 가져와 flag로 씀.
          if(flag === "1"){
            alert('메일이 발송되었습니다.');
            $('input[name=title]').val('');
            $('textarea').val('');
            $('#btn_email_submit').text('발송');
            $("input[name=receiver").val('');
            $("#receiver_label").show();
          }else if(flag == "2"){
              alert('메일 발송에 실패하였습니다.');
          }else { // 메일을 보내지 않은 경우. = 양식 저장의 경우.
              alert(res);
          }
      },
      error : console.log
  })
}
// 이메일 정보 수정
function updateEmailInfo(){
    // 비밀번호 미입력시 return false
    if($('input[name=pw]').val() === ''){
        return false;
    }
    $.ajax({
        url : '<?= PATH ?>/email/email_process.php',
        method : 'post',
        data : {
            address : $('input[name=address]').val(),
            password : $('input[name=pw]').val(),
            mode : 'update_info'
        },
        success(res){
            alert(res);
            $('input[name=pw]').val('');
            $('.modal').hide();
        },
        error : console.log
    })
}
</script>
<?php include_once('../../footer.php') ?>