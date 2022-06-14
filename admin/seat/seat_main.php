<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./admin/custom_lib/css/seat.css">
    <title>Seat</title>
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
<script src="./admin/custom_lib/js/seat.js"></script>
</html>