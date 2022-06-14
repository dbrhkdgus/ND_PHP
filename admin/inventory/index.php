<?php require_once('../header.php') ?>
<link rel="stylesheet" href="../custom_lib/css/modal.css">
<link rel="stylesheet" href="../custom_lib/css/inventory.css">
<section id="main-content">
      <section class="wrapper">
      
      <?php include('../custom_lib/template/search_form.php') ?>

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="box-shadow: 0 0 0;">
          <div class="card-body">
            <h4 class="card-title" onClick="location.reload()" style="cursor : pointer;"> Inventory Summary</h4>
            <p class="card-description"> <code></code> </p>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width : 20%;"> 상품 이미지 </th>
                  <th> 상품명 </th>
                  <th> 가격 </th>
                  <th> 카테고리 </th>
                  <th> 재고 수량 </th>
                  <th> 발주처 </th>
                  <th> 상세 보기 </th>
                </tr>
              </thead>
              <tbody class="result">
                  <?php include('./getInventoryList.php'); allItems();?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- 모달창 -->
      <div class="modal" id="item_detail_modal">
        <div class="modal_body">제품 상세 정보
          <div class="close_modal" onClick="close_modal(this);">x</div>
            
        </div>
      </div>
      </section>
</section>
<script src="../custom_lib/js/common.js"></script>
<script src="../custom_lib/js/inventory.js"></script>

<?php include_once('../footer.php') ?>