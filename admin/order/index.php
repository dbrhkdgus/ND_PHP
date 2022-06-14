<?php require_once('../header.php') ?>
<link rel="stylesheet" href="../custom_lib/css/modal.css">
<style>
    #last_td{text-align: center;}
    #last_td > button {width:90%; margin-top: 5%;}

    .order_info_form_box{
        text-align: left;
    }
    .order_info_form_box > form > label{
        width : 100%;
    }
    .order_info_form_box > form > label > p{
        width: 20%;
        float: left;
    }
    .tel_input{
        width : 15%;
    }

    textarea{
        resize : none;
    }

    .order_btn_box button{
        width : 100%;
    }

    
</style>
<section id="main-content">
    <section class="wrapper">
    <?php include('../custom_lib/template/search_form.php') ?>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="box-shadow: 0 0 0;">
            <div class="card-body">
                <h4 class="card-title" onClick="location.reload()" style="cursor : pointer;"> 발주처 관리</h4>
                <p class="card-description"></p>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th> 발주처 </th>
                        <th> email </th>
                        <th> 전화 번호 </th>
                        <th> 정보 수정</th>
                        <th> 발주 메일 수정</th>
                    </tr>
                </thead>
                <tbody class="result">
                    <?php include('../custom_lib/template/getOrderInfo.php'); echo getOrderList(); ?>
                </tbody>
            </table>
        </div>
    </div>
    </section>
    <!-- 모달창 -->
    <div class="modal" id="order_info_detail_modal">
        <div class="modal_body">발주처 관리
            <div class="close_modal" onClick="close_modal(this);">x</div>
            
        </div>
    </div>

</section>

<script src="../custom_lib/js/common.js"></script>
<script src="../custom_lib/js/order_info.js"></script>

<?php require_once('../footer.php') ?>