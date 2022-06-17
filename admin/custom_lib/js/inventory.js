const PATH = 'http://localhost/ND_PHP/admin/';
//  window.addEventListener('click', (e) => {
//    if($(e.target).is($('#item_detail_modal'))){
//      console.log($(e.target).is($('#item_detail_modal')));
//      $(e.target).hide();
//    }
//  })

function search(e){
  // search form을 가져옴.
  var form = $(e).parents('form');
  // FormData 객체로 변형
  var formData = new FormData(form[0]);
  var obj = {};
  // 구조분해 할당
  for(const [k, v] of formData){
    obj[k] = v;
  };
  //json 객체로 변형
  const jsonStr = JSON.stringify(obj);
  
  // 비동기 호출
  $.ajax({
    url : PATH + "inventory/search.php",
    method : 'get',
    data : {
      data : jsonStr
    },
    success(res){
      // 성공 시, 조회단에 결과물 append.
      $(".result").html('').append(res);
    },
    error : console.log
  })
}

// 제품 상세보기
function itemDetail(id){
  // 비동기 통신, id값 전달
  $.ajax({
    url : PATH + 'custom_lib/template/getModalDetail.php',
    method : 'get',
    data : {
      id : id,
      mode : 'item_detail'
    },
    success(res){
      // 모달창 초기 세팅
      $(".modal_body")
      .html('제품 상세 정보<div class="close_modal" onClick="close_modal(this);">x</div>')
      .append(res); // 결과물 append. (내용이 들어있는 template)
      getOrderInfo('f'); // 발주처 정보 불러오는 함수 호출. 매개변수는 function에서 호출했다는 뜻.
      $('.modal').show(); // 모달창 띄움.
    },
    error : console.log
  })
}

// 제품 추가
function addInventory(){
  $.ajax({
    url : PATH + 'custom_lib/template/getModalDetail.php',
    method : 'get',
    data : {
      mode : 'item_default'
    },
    success(res){
      // 모달창 초기 세팅
      $(".modal_body")
        .html('제품 상세 정보<div class="close_modal" onClick="close_modal(this);">x</div>')
        .append(res); // 결과물 append. (내용이 비어있는 template)
      $('.modal').show();
    },
    error : console.log
  })
}

// CRUD 요청 함수
function inventory_process(mode, id){
  // 실제 변경이 일어났을 때에만, 비동기 요청을 보내도록 함.
  var flag = $.parseJSON($('input[name=isChanged').val());

  // 삭제버튼 클릭시에는 기타 변경사항이 없으므로,
  // delete요청의 경우는 flag값을 true로 변경
  if(mode === 'delete'){
    if(confirm("정말로 삭제하시겠습니까?")){
      flag = true;
    }
  }

  // 변경이 일어난 경우
  if(flag){
    // form 값 가져오기 및 FormData  -> 구조분해 할당
     var form = $(document["inventory_detail"])
     var formData = new FormData(form[0]);
     var obj = {};
     for(const [k, v] of formData){
       obj[k] = v;
     };

     // 발주처 정보는 form태그 외부에 있으므로, 발주처 id 값을 obj에 새로운 값으로 추가해줌.
     obj.order_info_id = $('select[name=order_info_id] :selected').val();
     const jsonStr = JSON.stringify(obj); // jsonStr 처리

     $.ajax({
       url : PATH + 'custom_lib/template/inventory_process.php',
       method : 'post',
       data : {
         jsonStr : jsonStr,
         mode : mode,
         id : id
       },
       success(res){
         alert(res); // response로 받아온 메시지 alert
         location.reload();  // 변경된 내용으로 출력되도록 location.reload()
       },
       error : console.log
     })
  // 변경 사실이 없는 경우 -> 닫기버튼이므로 모달창을 닫음.
  }else{
    $('#item_detail_modal').hide();
  }

}

// 발주처 정보를 가져오는 함수
function getOrderInfo(mode){
  // select태그에서 선택된 값을 id로 
  var id = $("select[name=order_info_id] :selected").val();

  // id = 0인 경우는 제품추가 버튼 클릭했을 때를 위해서임.
  if(id != 0){
    $.ajax({
      url : PATH + 'custom_lib/template/order_info_process.php',
      method : 'get',
      data : {
        id : id,
        mode : 'getOrderInfo'
      },
      success(res){
        var{tel, email, memo} = JSON.parse(res); // response값 구조분해 할당
        
        // 내용 채움
        $("#order_info_tel").text(tel);
        $("#order_info_email").text(email);
        $("textarea").text(memo);
        // itemDetail()에서 호출한 경우는 초기 발주처 정보 조회만 필요
        // 사용자의 수정이 일어난 것이 아니기 때문에 is_changed()함수를 호출하지 않는다.
        if(mode === 't'){ // 실제 사용자가 select태그에서 값을 변경했을 때에만 
          is_changed('update'); // 변경한 것으로 함.
        }
      },
      error : console.log
    })

  // 제품 추가 버튼 클릭 시,
  // 발주처 정보는 비어있는 상태.
  }else{
    $("#order_info_tel").text('');
    $("#order_info_email").text('');
    $("textarea").text('');
  }
}

// 가짜 사진 수정 함수
function btn_img_change(){
  // css 상 button태그로 사진수정을 구현했기때문에
  // input[type=file]이 눌린 것처럼 동작하게 한다.
  $("input[name=img").click();
}

// 진짜 사진 수정 함수
function img_change(e){
  var file = e.target;
  var form = new FormData();
  
  // 사진 미리보기를 위해서 FileReader로 읽어옴
  // 아래 api를 통해 반환된 url값으로 바꿔주면, 사진이 느리게 반응함.
  // 때문에 api거치기전 시스템 내부에서 빠르게 사진 변경해줌.
  var reader = new FileReader();
  reader.onload = function(e) {
    $('#modal_img').attr('src', e.target.result); // img태그의  src값 변경 : 즉시 변경
  }
  reader.readAsDataURL(file.files[0]); 
  
  // 사진을 내부 디렉토리에 upload시키지 않음.
  // 사진 파일을 url구조로 바꿔서 주는 api 이용함.
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
  
  // 이미지 업로드 -> url값 가져오기
  $.ajax(settings).done(function (response) {
    var imgbb = JSON.parse(response);
    var url = imgbb.data.thumb.url; 
    $("input[name=img_url]").val(url); // 디비 테이블에 담기는건 이 url값임. form에 넘겨주기 위해 hidden에 넣어줌.
    is_changed('update'); // 비동기 통신이 완료되었을 때 (= url값이 담긴 것이 확실할 때), 수정이 발생한 것으로 간주.
  });

}



function is_changed(mode){
  $("input[name=isChanged]").val(true);
  
  // 변경이 일어난 지점이 
  // 상세보기에서인 경우 
  if(mode === 'update'){
    $("#btn_item_detail_submit").text('수정'); // 닫기버튼이 수정버튼으로
  // 제품 추가인 경우
  }else if(mode === 'insert'){
    $("#btn_item_detail_submit").text('등록'); // 닫기버튼이 등록버튼으로
  }
  

}