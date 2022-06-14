<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat</title>
    <style>
        .seats-box-body {
            width : 100%;
            height : 100%;
            border : 1px solid black;
            border-radius : 3px;
            background : white;
            text-align : center;
        }  
        .seats-box-content {
            display : inline-block;
            text-align : center;
        }
        .seat {
            margin : 10px;
            display : inline-block;
            width : 40px;
            height : 40px;
        }
        .none {
            border : none;
            display : hidden;
        }
        .empty, .selected, .occupy {
            border : 1px solid black;
            border-radius : 3px;
        }
        .empty {
            background : white;
        }
        .empty:hover {
            background : gray;
        }
        .selected {
            background : blue;
        }
        .occupy {
            background : black;
        }
    </style> 
</head>
<body>
    <div class='seats-box-body'>
        <div class='seats-box-content'>
            <?php include_once('getSeat.php') ?>
        </div><!-- /.seats-box-content -->
    </div><!-- /.seats-box-body -->
</body>

<script src="https://code.jquery.com/jquery-3.6.0.js" 
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" 
        crossorigin="anonymous"></script>
<script>
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

    function cancelSeat(x, y) {
        // empty 클래스 및 selectSeat 이벤트 부여
        $target = $("div[data-x=" + x +"][data-y=" + y + "]");
        $target.removeClass("selected");
        $target.addClass("empty");
        $target.removeAttr("onclick");
        $target.attr("onclick", "selectSeat(" + x + "," + y + ")");
    }
</script>
</html>