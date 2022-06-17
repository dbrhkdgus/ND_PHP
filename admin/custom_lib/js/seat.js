// 좌석 선택
function selectSeat(x, y) {
    // selected 클래스 조회
    const classNames = [];
    $.each($(".selected"), function() {
        classNames.push($(this).val());
    });
    
    // selected 클래스 및 cancelSeat 이벤트 부여
    if(classNames.length == 0) {
        $target = $("div[data-x=" + x +"][data-y=" + y + "]");
        $target.removeClass("empty");
        $target.addClass("selected");
        $target.removeAttr("onclick");
        $target.attr("onclick", "cancelSeat(" + x + "," + y + ")");
    }
    else {
        alert("아이디 당 하나의 좌석만 선택 가능합니다.");
    }
}

// 좌석 선택 취소
function cancelSeat(x, y) {
    // empty 클래스 및 selectSeat 이벤트 부여
    $target = $("div[data-x=" + x +"][data-y=" + y + "]");
    $target.removeClass("selected");
    $target.addClass("empty");
    $target.removeAttr("onclick");
    $target.attr("onclick", "selectSeat(" + x + "," + y + ")");
}

// 관리자 좌석 선택
function checkSeat(x, y) {
    $target = $("div[data-x=" + x +"][data-y=" + y + "]");
    console.log("(" + y + ", " + x + ") 좌석을 선택하셨습니다.");

    // DB 고민 좀 더 필요....ㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠ
}