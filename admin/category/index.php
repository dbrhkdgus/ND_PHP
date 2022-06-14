<?php require_once('../header.php') ?>
<link rel="stylesheet" href="../custom_lib/css/modal.css">
<style>
    #last_tr{text-align: center;}
    #last_tr > button {width:90%; margin-top: 5%;}
    .add_cte_form_box {
        width: 100%;
        text-align: left;
    }
    .add_cte_form_box > label{
        width:100%;
    }
    .add_cte_form_box > label > input {
        width: 70%;
    }

    #btn_resit_cte{width: 100%; margin-top: 5%;}

</style>
<section id="main-content">
    <section class="wrapper">
    <?php include('../custom_lib/template/search_form.php') ?>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card" style="box-shadow: 0 0 0;">
            <div class="card-body">
                <h4 class="card-title" onClick="location.reload()" style="cursor : pointer;"> 카테고리 관리</h4>
                <p class="card-description"> <code></code> </p>
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th> 카테고리명 </th>
                        <th> 내부 아이템 </th>
                        <th colspan="2"> 컨트롤 </th>
                    </tr>
                </thead>
                <tbody class="result">
                    <?php echo getCteListTag(); ?>
                </tbody>
                </table>
            </div>
            </div>
        </div>
        <!-- 모달창 -->
        <div class="modal" id="cte_add_modal">
            <div class="modal_body" style="height:200px">카테고리 추가
                <div class="close_modal" onClick="close_modal(this);">x</div>
                <hr>
                <div class="add_cte_form_box">
                        <label for=""> 카테고리 명 : 
                            <input type="text" id="new_name" name="name" placeholder="카테고리 명을 입력하세요.">
                        </label>
                    <button id="btn_resit_cte" onClick="resit_cte();">등록하기</button>        
                </div>
            </div>
        </div>
      </section>
    </section>
</section>
<script src="../custom_lib/js/common.js"></script>
<script src="../custom_lib/js/category.js"></script>

<?php require_once('../footer.php') ?>