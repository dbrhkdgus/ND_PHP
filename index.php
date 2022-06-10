<?php
    include_once('config.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="<?php echo PATH?>/css/main.css">
</head>
<body>
    <div class="wrap">

        <div class="title-seats-box">
            <div class="title-box">
                <h3 style="margin : 0px;">내담 P씨방</h3>
                <p>미쳐버린 사장님의 파격할인중!</p>
            </div>
            
            <!-- 좌석 정보 패널 -->
            <div class="seats-box">


            </div>
        </div>

        <div class="food-and-login-wrap">
            <!-- 메뉴 -->
            <div class="food-box">
                <?php include_once('./getInventory.php') ?>
            </div>
            
            <!-- 로그인/회원가입 -->
            <div class="login-box">
                <form action="">
                    <label for="">ID : <input type="text"></label>
                    <label for="">PW : <input type="password"></label>
                </form>  
            </div>
        </div>
        
    </div>
</body>
</html>