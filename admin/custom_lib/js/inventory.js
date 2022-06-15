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
      $(".modal_body")
      .html('제품 상세 정보<div class="close_modal" onClick="close_modal(this);">x</div>')
      .append(res);
      getOrderInfo();
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
      $(".modal_body")
        .html('제품 상세 정보<div class="close_modal" onClick="close_modal(this);">x</div>')
        .append(res);
      $('.modal').show();
    },
    error : console.log
  })


}

function inventory_process(mode, id){
  var flag = $.parseJSON($('input[name=isChanged').val());
  if(mode === 'delete'){
    if(confirm("정말로 삭제하시겠습니까?")){
      flag = true;
    }
  }
  if(flag){
     var form = $(document["inventory_detail"])
     var formData = new FormData(form[0]);
     var obj = {};
     for(const [k, v] of formData){
       obj[k] = v;
     };
     obj.order_info_id = $('select[name=order_info_id] :selected').val();
     const jsonStr = JSON.stringify(obj);
     console.log(jsonStr);
     $.ajax({
       url : PATH + 'custom_lib/template/inventory_process.php',
       method : 'post',
       data : {
         jsonStr : jsonStr,
         mode : mode,
         id : id
       },
       success(res){
         alert(res);
         location.reload();         
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
        is_changed();
      },
      error : console.log
    })

  }else{
    $("#order_info_tel").text('');
    $("#order_info_email").text('');
    $("textarea").text('');
  }
}


function btn_img_change(){
  $("input[name=img").click();
}

function img_change(e){
  var file = e.target;
  var form = new FormData();
  
  var reader = new FileReader();
  reader.onload = function(e) {
    $('#modal_img').attr('src', e.target.result); 
  }
  reader.readAsDataURL(file.files[0]);
  
  
  
  
  
  form.append("image", file.files[0]);
  var settings = {
    "url": "https://api.imgbb.com/1/upload?key=f84bfb11eb3ee5eedb859de8b49fdff1",
    "method": "POST",
    "timeout": 0,
    "processData": false,
    "mimeType": "multipart/form-data",
    "contentType": false,
    "data": form
  };
  
  // 이미지 업로드 -> 확인
  $.ajax(settings).done(function (response) {
    var imgbb = JSON.parse(response);
    var url = imgbb.data.thumb.url;
    $("input[name=img_url]").val(url);
    is_changed();
  });

}





function is_changed(){
  $("input[name=isChanged]").val(true);
  
  $("#btn_item_detail_submit").text('수정');
  

}