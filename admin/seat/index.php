<?php require_once('../header.php') ?>

<section id="main-content">
    <section class="wrapper">
        <div class="seat-board">
            <div class="seat-board-div">
                <?php include_once('seatToAdmin.php') ?>
            </div>
            <div class="seat-board-div">
                <div>이용 정보 => 좌석 번호, 이용자 아이디, 이용자 전화번호, 잔여 이용 시간, 실시간 이용 금액</div>
                <div>좌석 정보 => 기기 정보</div>
            </div>
        </div>
    </section>   
</section>

<?php include_once('../footer.php') ?>