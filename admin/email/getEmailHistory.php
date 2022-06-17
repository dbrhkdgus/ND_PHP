<?php
    require_once($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\DataBase\connection.php');
    $sql = 'select * from email_history order by id desc';
    $result = connect($sql);
    $tag = '';
    $idx = mysqli_num_rows($result);
    while($history = mysqli_fetch_array($result)){
        $content = '';
        if(mb_strlen($history["content"],"UTF-8") < 20){
            $content = $history["content"];
        }else{
            // 길어지면 ...표시
            $content = mb_substr($history["content"],1,20,"UTF-8")."...";
        };
        $tag = $tag.'
            <tr onClick="emailDetail('.$history["id"].')">
                <td>'.$idx.'</td>
                <td>'.$history["receiver"].'</td>
                <td>'.$history["title"].'</td>
                <td>'.$content.'</td>
                <td>'.$history["send_date"].'</td>
            </tr>
        ';

        $idx -= 1;
    }
    echo $tag;
?>