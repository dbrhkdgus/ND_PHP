const PATH = 'http://localhost/ND_PHP/admin/';

function updateCte(id){
    var isChanged = '#isChanged-'+id;
    if($(isChanged).val() == "true"){
        var target = '#cte_name-'+id;
        var name = $(target).val(); 
        console.log(name);
        $.ajax({
            url : PATH + 'custom_lib/template/category_process.php',
            method : 'get',
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

function resit_cte(){
    var name = $('#new_name').val();
    $.ajax({
        url : PATH + 'custom_lib/template/category_process.php',
        method : 'get',
        data : {
            name : name,
            mode : 'insert'
        },
        success(res){
            console.log(res)
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