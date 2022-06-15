<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../custom_lib/css/seat.css">
    <title>seat_admin</title>
</head>
<body>
    <form action="./process.php?mode=selectSeat" method="post">
        <div class="seats-box-content">
            <div class="seats-box-body">
                <?php include_once('getSeat.php'); getSeatToAdmin(); ?>
            </div><!-- /.seats-box-body -->
        </div><!-- /.seats-box-content -->
    </form>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js" 
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" 
        crossorigin="anonymous"></script>
<script src="../custom_lib/js/seat.js"></script>
</html>