const PATH = 'http://localhost/ND_PHP/admin/';
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
      url : PATH + "inventory/search.php",
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
    url : PATH + 'custom_lib/template/getModalDetail.php',
    method : 'get',
    data : {
      id : id,
      mode : 'item_detail'
    },
    success(res){
      $(".modal_body").html('제품 상세 정보<div class="close_modal" onClick="close_modal(this);">x</div>').append(res);
      $('.modal').show();
    },
    error : console.log
  })
}

function addInventory(){
  $.ajax({
    url : PATH + 'custom_lib/template/getModalDetail.php',
    method : 'get',
    data : {
      mode : 'item_default'
    },
    success(res){
      $(".modal_body").html('제품 상세 정보<div class="close_modal" onClick="close_modal(this);">x</div>').append(res);
      $('.modal').show();
    },
    error : console.log
  })


}

function inventory_process(mode, id){
  var flag = $.parseJSON($('input[name=isChanged').val());
  if(flag){
     var form = $(document["inventory_detail"])
     var formData = new FormData(form[0]);
     var obj = {};
     for(const [k, v] of formData){
       obj[k] = v;
     };
     const jsonStr = JSON.stringify(obj);
     $.ajax({
       url : PATH + 'custom_lib/template/inventory_process.php',
       method : 'post',
       data : {
         jsonStr : jsonStr,
         mode : mode,
         id : id
       },
       success(res){
         console.log(res);
         alert(res)
       },
       error : console.log
     })
  }else{
    $('#item_detail_modal').hide();
  }

}

function getOrderInfo(){
  var id = $("select[name=order_info_id] :selected").val();
  if(id != 0){

    $.ajax({
      url : PATH + 'custom_lib/template/order_info_process.php',
      method : 'get',
      data : {
        id : id,
        mode : 'getOrderInfo'
      },
      success(res){
        var{tel, email, memo} = JSON.parse(res);
        
        $("#order_info_tel").text(tel);
        $("#order_info_email").text(email);
        $("textarea").text(memo);
      },
      error : console.log
    })

  }else{
    $("#order_info_tel").text('');
    $("#order_info_email").text('');
    $("textarea").text('');
  }
}

function is_changed(){
  $("input[name=isChanged]").val(true);
  
  $("#btn_item_detail_submit").text('수정');
  

}