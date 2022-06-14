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
      mode : 'item'
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
         alert('제품 정보가 수정되었습니다.')
       },
       error : console.log
     })
  }else{
    $('#item_detail_modal').hide();
  }

}

function is_changed(){
  $("input[name=isChanged]").val(true);
  
  $("#btn_item_detail_submit").text('수정');
  

}