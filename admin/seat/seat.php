<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat</title>
</head>
<body>
    <p id="test"></p>
</body>
<script>
    $(function(){
        $.ajax({
            url : 'getSeat.php',
            method : 'get',
        }).done(function(data){
            $("#test").(data);
        });
    });
</script>
</html>