<?php require_once('../../header.php') ?>
<?php include('../email_process.php') ?>
<link rel="stylesheet" href="../../custom_lib/css/modal.css">
<link rel="stylesheet" href="../css/email_setting.css">
<section id="main-content">
    <section class="wrapper">
    <?php include('../../custom_lib/template/search_form.php') ?>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card" style="box-shadow: 0 0 0;">
                <div class="card-body">
                    <h4 class="card-title" onClick="location.reload()" style="cursor : pointer;"> 이메일 양식 설정 </h4>
                    <form name="email_form" onsubmit="return false">
                        <div class="email_setting_box">
                            <label for="">
                                <p>보내는 주소  </p><input type="email" name="address" value="<?= getEmailInfo()['address']; ?>" >
                            </label>
                            <div class="form_handling_box">
                            <label>
                                <p>자동 전송 양식</p><input type="checkbox" name="auto" value="auto" onChange="auto_check_control(event);" checked="checked">
                            </label>
                            <label >
                                <p style="margin-left : 1%;">일반 메일 전송</p><input type="checkbox" name="auto" value="manual" onChange="auto_check_control(event);">
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
    </section>
</section>
<script src="../../custom_lib/js/common.js"></script>
<script>
    function auto_check_control(e){
        $(e.target).parent().siblings().children("input").attr('checked', false);

        if($("input[name=auto]:checked").val() == 'auto'){
            $('input[name=title]').val('<?= getEmailInfo()["title"] ?>');
            $('textarea').text(`<?php echo getEmailForm(); ?>`);
            $('#btn_email_submit').text('저장');
            $("#receiver_label").hide();
        }else{
            $('input[name=title]').val('');
            $('textarea').text('');
            $('#btn_email_submit').text('발송');
            $("input[name=receiver").val('');
            $("#receiver_label").show();
        }
    }

    function mail_process(){
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
            success(res){
                var flag = res.slice(-1);
                if(flag){
                    alert('메일이 발송되었습니다.');
                }else{
                    alert('메일 발송에 실패하였습니다.');
                }
            },
            error : console.log
        })
    }

</script>
<?php include_once('../../footer.php') ?>