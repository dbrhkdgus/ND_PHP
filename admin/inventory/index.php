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
                      <tbody class="result">
                          <?php include('getInventoryList.php'); allItems();?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
      </section>
</section>

<script>
  function search(e){
    var form = $(e).parents('form');
    var formData = new FormData(form[0]);
    var obj = {};
    for(const [k, v] of formData){
      obj[k] = v;
    };

    const jsonStr = JSON.stringify(obj);

    $.ajax({
      url : "search.php",
      method : 'get',
      data : {
        data : jsonStr
      },
      success(res){
        $(".result").html('').append(res);
      },
      error : console.log

    })
  }

</script>

<?php include_once('../footer.php') ?>