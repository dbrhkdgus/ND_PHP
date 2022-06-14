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
                console.log(res);
                alert('카테고리 정보가 수정되었습니다.');
                location.reload();
            },
            error : console.log
        });
    }else{
        return false;
    }

}

function is_changed(id){
    var target = '#isChanged-'+id;
    $(target).val(true);
    
}