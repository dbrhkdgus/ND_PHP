const PATH = 'http://localhost/ND_PHP/admin/';
function orderUpdate(id){
    $.ajax({
        url : PATH + 'custom_lib/template/getModalDetail.php',
        method : 'get',
        data : {
            id : id,
            mode : 'order_info'
        },
        success(res){
            $(".modal_body")
                .html('발주처 관리<div class="close_modal" onClick="close_modal(this);">x</div>')
                .append(res);
            $("#order_info_detail_modal").show();
        },
        error : console.log
    })
}

function order_info_process(mode, id){
    var isChanged = $("input[name=isChanged").val();
    if(isChanged === 'true'){
        var form = $(document["order_info_form"]);
        var formData = new FormData(form[0]);
        var obj = {};
        
        for(const [k, v] of formData){
          obj[k] = v;
        };

        var jsonStr = JSON.stringify(obj);

        $.ajax({
            url : PATH + 'custom_lib/template/order_info_process.php',
            method : 'get',
            data : {
                id : id,
                jsonStr : jsonStr,
                mode : 'update'
            },
            success(res){
                alert("발주처 정보가 수정되었습니다.");
                $('#order_info_detail_modal').hide();
                location.reload();
            },
            error : console.log

        })
    }else{
        $('#order_info_detail_modal').hide();
    }
}

function moveToEmail(id){
    console.log('email',id);
}

function addOrderInfo(){
    console.log('발주처 추가');
    
    // <hr>
    //         <div class="order_info_form_box">
    //             <form name="order_info_form" onSubmit="return false">
    //                 <input type="hidden" name="isChanged" value="false">
    //                 <label for="">
    //                     <p>발주처 : </p><input type="text" name="name" value="농심" onChange="is_change();">
    //                 </label>
    //                 <label for="">
    //                     <p>Email : </p><input type="email" name="email" value="ns@mail.com" onChange="is_change();">
    //                 </label>
    //                 <label for="">
    //                     <p>전화번호 : </p><input class="tel_input valid" type="text" name="tel1" value="000" onChange="is_change();"> - <input class="tel_input valid" type="text" name="tel2" value="0000" onChange="is_change();"> - <input class="tel_input valid" type="text" name="tel3" value="0000" onChange="is_change();">
    //                 </label>
    //             </form>
    //         </div>
    //         <hr>
    //         <div class="order_btn_box">
    //             <button id="btn_update_order_info" onClick="order_info_process('update');">닫기</button>
    //         </div>
    
}

function is_change(){
    $("#btn_update_order_info").text('수정');
    $("input[name=isChanged").val(true);
}