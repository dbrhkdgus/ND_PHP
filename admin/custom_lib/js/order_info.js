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
                mode : mode
            },
            success(res){
                alert(res);
                $('#order_info_detail_modal').hide();
                location.reload();
            },
            error : console.log

        })
    }else{
        $('#order_info_detail_modal').hide();
    }
}

function orderDelete(id){
    if(confirm('발주처 정보를 삭제하시겠습니까?')){
        $.ajax({
            url : PATH + 'custom_lib/template/order_info_process.php',
            method : 'get',
            data : {
                id : id,
                mode : 'delete'
            },
            success(res){
                alert(res);
                $('#order_info_detail_modal').hide();
                location.reload();
            },
            error : console.log

        })
    }else{
        return false;
    }
}

function addOrderInfo(){
    var tag = `    <hr>
    <div class="order_info_form_box">
        <form name="order_info_form" onSubmit="return false">
            <input type="hidden" name="isChanged" value="false">
            <label for="">
                <p>발주처 : </p><input type="text" name="name" value="" onChange="is_change(\'insert\');">
            </label>
            <label for="">
                <p>Email : </p><input type="email" name="email" value="" onChange="is_change(\'insert\');">
            </label>
            <label for="">
                <p>전화번호 : </p><input class="tel_input valid" type="text" name="tel1" value="" onChange="is_change(\'insert\');"> - <input class="tel_input valid" type="text" name="tel2" value="" onChange="is_change(\'insert\');"> - <input class="tel_input valid" type="text" name="tel3" value="" onChange="is_change(\'insert\');">
            </label>
            <label for="">
                <p>메모 : </p> <textarea name="memo" cols="30" rows="10" onChange="is_change(\'insert\');"></textarea>
            </label>
        </form>
    </div>
    <hr>
    <div class="order_btn_box">
        <button id="btn_update_order_info" onClick="order_info_process('insert', 0);">닫기</button>
    </div>`;
    $(".modal_body")
        .html('발주처 관리<div class="close_modal" onClick="close_modal(this);">x</div>')
        .append(tag);
    $("#order_info_detail_modal").show();
    

    
}

function is_change(mode){
    if(mode === 'update'){
        $("#btn_update_order_info").text('수정');
    }else{
        $("#btn_update_order_info").text('등록');
    }
    $("input[name=isChanged").val(true);
}