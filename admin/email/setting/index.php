<?php require_once('../../header.php') ?>
<link rel="stylesheet" href="../../custom_lib/css/modal.css">
<link rel="stylesheet" href="../css/email_setting.css">
<section id="main-content">
    <section class="wrapper">
    <?php include('../../custom_lib/template/search_form.php') ?>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card" style="box-shadow: 0 0 0;">
                <div class="card-body">
                    <h4 class="card-title" onClick="location.reload()" style="cursor : pointer;"> 이메일 설정 </h4>
                    <div class="email_setting_box">
                        <label for="">
                            <p>보내는 주소  </p><input type="email" name="address" value="" onChange="is_change(\'insert\');">
                        </label>
                        <div class="form_handling_box">
                            <label>
                                <p>자동 전송 양식</p><input type="checkbox" name="auto" value="" onChange="" checked>
                            </label>
                            <label >
                                <p style="margin-left : 1%;">일반 메일 전송</p><input type="checkbox" name="auto" value="" onChange="">
                            </label>
                        </div>
                        <label id="recipient_label"  for="">
                            <p>받는 주소  </p><input type="email" name="name" value="" onChange="is_change(\'insert\');">
                        </label>
                        <label for="">
                            <p>제목  </p><input type="text" name="title" value="" onChange="">
                        </label>
                        <textarea name="" id="" cols="30" rows="20"><?php include('./read_email_form_file.php'); echo getEmailForm(); ?></textarea>
                        <button id="btn_email_submit">저장</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<script src="../../custom_lib/js/common.js"></script>

<?php include_once('../../footer.php') ?>