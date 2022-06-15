const PATH = 'http://localhost/ND_PHP/admin/';

function updateCte(id){
    var isChanged = '#isChanged-'+id;
    if($(isChanged).val() == "true"){
        var target = '#cte_name-'+id;
        var name = $(target).val(); 
        console.log(name);
        $.ajax({
            url : PATH + 'custom_lib/template/category_process.php',
            method : 'post',
            data : {
                id : id,
                name : name,
                mode : 'update'
            },
            success(res){
                alert('카테고리 정보가 수정되었습니다.');
                location.reload();
            },
            error : console.log
        });
    }else{
        return false;
    }

}

function deleteCte(id, cnt){
    if(confirm("카테고리 내부 아이템이 모두 삭제됩니다.\n내부 아이템 카테고리 이동을 권고드립니다. \n삭제하시겠습니까?")){
        if(cnt > 0){
            if(!confirm(cnt+'개의 아이템이 존재합니다. \n삭제를 계속하시겠습니까?')){
                return false;
            }
        }
            $.ajax({
                url : PATH + 'custom_lib/template/category_process.php',
                method : 'post',
                data : {
                    id : id,
                    mode : 'delete'
                },
                success(res){
                    console.log(res);
                    alert('삭제되었습니다.');
                    location.reload();
                },
                error : console.log
            });
    }
}
    
    function resit_cte(){
    var name = $('#new_name').val();
    $.ajax({
        url : PATH + 'custom_lib/template/category_process.php',
        method : 'post',
        data : {
            name : name,
            mode : 'insert'
        },
        success(res){
            alert('카테고리가 추가되었습니다.');
            location.reload();
        },
        error : console.log
        
    })
    
}

function addCte(){
    $('#new_name').val('');
    $("#cte_add_modal").show();
}

function is_changed(id){
    var target = '#isChanged-'+id;
    $(target).val(true);
    
}