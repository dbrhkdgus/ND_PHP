<?php
    require_once($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\DataBase\connection.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\admin\email\PHPMailer\src\PHPMailer.php"'); 
    require($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\admin\email\PHPMailer\src\SMTP.php"'); 
    require($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\admin\email\PHPMailer\src\Exception.php'); 

    if(isset($_POST["jsonStr"])){
        $item = json_decode($_POST["jsonStr"], true);
        $mode = $item["auto"];
        if($mode === 'auto'){
            $sql = 'update email set address = \''.$item["address"].'\', title = \''.$item["title"].'\'';
            $result = connect($sql);
            
            $fp = fopen("./setting/admin_email_form.txt", "w") or die("파일을 열 수 없습니다！");
            $data = $item["content"];
            fwrite($fp, $data);
            fclose($fp);

            echo '이메일 설정이 저장되었습니다.';
        }else if($mode === 'manual'){
            $result = connect('select * from email');
            $email_info = '';

            while($row = mysqli_fetch_array($result)){
                $email_info = array("address" => $row["address"], "password" => $row["password"]);
            }

            $address = $email_info["address"];
            $mailType = explode('@', $address)[1];
            $password = $email_info["password"];

            $receiver = $item["receiver"];
            $title = $item["title"];
            $content = $item["content"];
            $file = '';
            
            $result = sendMail($mailType, $address , $password, $receiver, $title, $content, $file);
            
            
            echo $result;
        };
        
    }


    function getEmailForm(){
        $fp = fopen("admin_email_form.txt", "r") or die("파일을 열 수 없습니다！");
        $form = '';
        while( !feof($fp) ) {
            $form = $form.fgets($fp);
        }
        fclose($fp);

        return $form;
    }

    function getEmailInfo(){
        $result = connect('select * from email');
        $arr = '';

        while($row = mysqli_fetch_array($result)){
            $arr = array("address" => $row["address"], "title" => $row["title"]);
        }

        return $arr;
    }

    function sendMail($mailType, $address, $password, $receiver, $title, $content, $file){
        $mail = new PHPMailer(true);

            try {
            // 서버세팅
            //디버깅 설정을 0 으로 하면 아무런 메시지가 출력되지 않습니다
            $mail -> SMTPDebug = 2; // 디버깅 설정
            $mail -> isSMTP(); // SMTP 사용 설정
            // 지메일일 경우 smtp.gmail.com, 네이버일 경우 smtp.naver.com
            $mail -> Host = "smtp.".$mailType; // 네이버의 smtp 서버
            
            
            $mail -> SMTPAuth = true; // SMTP 인증을 사용함
            $mail -> Username = $address; // 메일 계정 (지메일일경우 지메일 계정)
            $mail -> Password = $password;// 메일 비밀번호
            $mail -> SMTPSecure = "ssl";// SSL을 사용함
            $mail -> Port = 465;// email 보낼때 사용할 포트를 지정
            
            $mail -> CharSet = "utf-8"; // 문자셋 인코딩
            
            // 보내는 메일
            $mail -> setFrom($address, $address);
            
            // 받는 메일
            $mail -> addAddress($receiver, $receiver);
            //$mail -> addAddress("test2@teacher21.com", "receive02");
            
            // 첨부파일
            //$mail -> addAttachment("./test1.zip");
            //$mail -> addAttachment("./test2.jpg");
            
            // 메일 내용
            $mail -> isHTML(true); // HTML 태그 사용 여부
            $mail -> Subject = $title; // 메일 제목
            $mail -> Body = $content; // 메일 내용
            
            // Gmail로 메일을 발송하기 위해서는 CA인증이 필요하다.
            // CA 인증을 받지 못한 경우에는 아래 설정하여 인증체크를 해지하여야 한다.
            $mail -> SMTPOptions = array(
             "ssl" => array(
             "verify_peer" => false
             , "verify_peer_name" => false
             , "allow_self_signed" => true
             )
            );
            
            // 메일 전송
            $mail -> send();
            
            return "1";
            
            } catch (Exception $e) {
                //$arr = array("msg" => "메일 발송에 실패하였습니다.", "error_info" => ($mail -> ErrorInfo));
                return "0";
            }
    }
?>