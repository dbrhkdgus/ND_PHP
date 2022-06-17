<?php
require_once($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\DataBase\connection.php');
include('./email_form_config.php');
include('../email_process.php');

// 사용자 이메일 양식 변수값 치환
$form = getEmailForm();





// email 계정/비번 초기화.
$query_result = connect('select * from email');
$email_info = '';
while($row = mysqli_fetch_array($query_result)){
    $email_info = array("address" => $row["address"], "password" => $row["password"], "title" => $row["title"]);
}
$address = $email_info["address"];
$mailType = explode('@', $address)[1];
$password = $email_info["password"];
$title = $email_info["title"];




// 자동 발송 설정되어있는 발주처에 대해서 해당 값 동적 할당
$sql = 'SELECT a.name AS p_name, a.amount, a.max_amt, email AS receiver, c.name
        FROM inventory a 
            JOIN rel_inventory_order b ON a.id = b.inventory_id
            JOIN item_order_info c ON c.id = b.order_info_id
        WHERE auto_email = true';
$query_result = connect($sql);
while($item = mysqli_fetch_array($query_result)){
    $quan = $item["max_amt"] - $item["amount"]; // 최대 재고량 - 현재 재고량 = 필요 수량
    $result_form = str_replace('[name]', $item["name"], $form);
    $result_form = str_replace('[p_name]', $item["p_name"], $result_form);
    $result_form = str_replace('[quan]', $quan, $result_form);
    $receiver = $item["receiver"];

    $content = $result_form;

    echo $content;
}

$file = '';


// 이후 음식 주문시, amount값이 maint_amt값보다 작아졌을 때, 이 php를 불러와 실행시키면 된다.
//$result = sendMail($mailType, $address , $password, $receiver, $title, $content, $file);

?>