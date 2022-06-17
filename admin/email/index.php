<?php require_once('../header.php') ?>
<link rel="stylesheet" href="../custom_lib/css/modal.css">
<link rel="stylesheet" href="../custom_lib/css/inventory.css">
<section id="main-content">
    <section class="wrapper">
    <?php include('../custom_lib/template/search_form.php') ?>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card" style="box-shadow: 0 0 0;">
                <div class="card-body">
                    <h4 class="card-title" onClick="location.reload()" style="cursor : pointer;"> 이메일 발송내역 </h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> 순서 </th>
                                <th> 수신자 </th>
                                <th> 제목 </th>
                                <th> 내용 </th>
                                <th> 날짜 </th>
                            </tr>
                        </thead>
                        <tbody class="result">
                            <?php include('./getEmailHistory.php') ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</section>

<script src="../custom_lib/js/common.js"></script>
<script src="../custom_lib/js/inventory.js"></script>
<script>
    function emailDetail(id){
        console.log(id); // 모달창 만들어서 email_detail 구현하면 댑니당.
    }

</script>
<?php include_once('../footer.php') ?>