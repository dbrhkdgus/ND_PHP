<?php require_once('../header.php') ?>
<style>
    .summary_img{
        width : 100px;
        height : 60px;
    }

</style>
<section id="main-content">
      <section class="wrapper">
      
        <?php include('search_form.php') ?>

      <div class="col-lg-12 grid-margin stretch-card">
                <div class="card" style="box-shadow: 0 0 0;">
                  <div class="card-body">
                    <h4 class="card-title">Inventory Summary</h4>
                    <p class="card-description"> <code></code> </p>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th style="width : 20%;"> 상품 이미지 </th>
                          <th> 상품명 </th>
                          <th> 가격 </th>
                          <th> 재고 수량 </th>
                          <th> 발주처 </th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php include('getInventoryList.php'); allItems();?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
      </section>
</section>


<?php include_once('../footer.php') ?>