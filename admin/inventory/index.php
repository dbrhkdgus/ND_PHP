<?php require_once('../header.php') ?>
<style>
  .summary_img{
        width : 100px;
        height : 60px;
    }
  .modal {
    position: absolute;
    top: 0;
    left: 0;

    width: 100%;
    height: 100%;

    display: none;

    background-color: rgba(0, 0, 0, 0.4);
  }

  .modal.show {
    display: block;
  }

  .modal_body {
    position: absolute;
    top: 50%;
    left: 50%;

    width: 400px;
    height: 650px;

    padding: 40px;

    text-align: center;

    background-color: rgb(255, 255, 255);
    border-radius: 10px;
    box-shadow: 0 2px 3px 0 rgba(34, 36, 38, 0.15);

    transform: translateX(-50%) translateY(-50%);
  }
  .close_modal{
    float : right;
    cursor : pointer;
  }
  .category_info{
    text-align: left;
    font-size: 18px;
  }


  .basic_info_box{
    display: flex;
    flex-direction: row;
  }
  .item_img_box{
    display: flex;
    flex-direction: column;
  }
  .item_info_table{
    margin-left: 2%;
  }
  .item_info_table > table >tbody > tr > th{
    width : 10%;
  }
  .item_info_table > table >tbody > tr > td{
    width : 20%;
    text-align: left;
  }
  .item_info_table > table >tbody > tr > td > input{
    width : 60%;
  }
  .submit_button > button{
    width : 100%;
  }
</style>
<section id="main-content">
      <section class="wrapper">
      
        <?php include('search_form.php') ?>

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
                  <?php include('getInventoryList.php'); allItems();?>

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

<script>
//  window.addEventListener('click', (e) => {
//    if($(e.target).is($('#item_detail_modal'))){
//      console.log($(e.target).is($('#item_detail_modal')));
//      $(e.target).hide();
//    }
//  })
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
function itemDetail(id){
  $.ajax({
    url : 'getItemDetail.php',
    method : 'get',
    data : {
      id : id
    },
    success(res){
      console.log(res);
      $(".modal_body").html('제품 상세 정보<div class="close_modal" onClick="close_modal(this);">x</div>').append(res);
      $('.modal').show();
    },
    error : console.log
  })
}

function close_modal(e){
  var modal = $(e).parents('.modal');
  modal.hide();
}

function inventory_process(mode, id){
  console.log(mode, id);
}

</script>

<?php include_once('../footer.php') ?>