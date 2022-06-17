const PATH = 'http://localhost/ND_PHP/admin/';

// 카테고리 업데이트
function updateCte(id){
    // 변경이 발생한 태그 감지
    var isChanged = '#isChanged-'+id;
    if($(isChanged).val() == "true"){ // 변경이 일어난 경우
        var target = '#cte_name-'+id;
        var name = $(target).val(); // 변경된 태그의 값을 읽어옴.

        // 비동기 통신
        $.ajax({
            url : PATH + 'custom_lib/template/category_process.php',
            method : 'post',
            data : {
                id : id,
                name : name,
                mode : 'update'
            },
            success(res){
                alert('카테고리 정보가 수정되었습니다.'); // res 메시지 호출
                location.reload(); // 결과 반영한 출력을 위해 리로드.
            },
            error : console.log
        });

    // 변경이 일어나지 않은 경우는 아무일도 발생하지 않음.
    }else{
        return false; 
    }

}

// 삭제 함수
function deleteCte(id, cnt){
    // 디비 테이블에 casacade 옵션이 걸려있어서 카테고리 삭제하면 싹다 지워짐.
    // 두번의 컨펌 요청.
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

// 등록 함수
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

// 카테고리 추가 버튼 클릭시, 비어있는 모달창 show.
function addCte(){
    $('#new_name').val('');
    $("#cte_add_modal").show();
}

// 변경 감지 함수.
function is_changed(id){
    var target = '#isChanged-'+id;
    $(target).val(true);
    
}