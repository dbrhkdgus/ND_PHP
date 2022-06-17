<?php
    require_once($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\DataBase\connection.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\admin\email\PHPMailer\src\PHPMailer.php"'); 
    require($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\admin\email\PHPMailer\src\SMTP.php"'); 
    require($_SERVER["DOCUMENT_ROOT"].'\ND_PHP\admin\email\PHPMailer\src\Exception.php'); 

    // javaScript에서 전달한 jsonStr의 존재 여부 파악. (현재의 php로 3개의 요청이 있음. 비동기 && php include)
    if(isset($_POST["jsonStr"])){ // 비동기 통신으로 현재 php가 요청이 되었다면,
        $item = json_decode($_POST["jsonStr"], true); // jsonStr를 decode
        $mode = $item["auto"]; // 자동 이메일 양식 저장인지 메일 보내기인지를 구분.
        
        // 자동 이메일 양식 저장인 경우, 
        if($mode === 'auto'){
            // email 주소, 제목을 update하는 쿼리. (비밀번호도 update하도록 해야함. 개선 필요.)
            $sql = 'update email set address = \''.$item["address"].'\', title = \''.$item["title"].'\'';
            $result = connect($sql);
            
            // 양식은 디비 테이블이 아닌 디렉토리에 직접 작성됨. 
            $fp = fopen("./setting/admin_email_form.txt", "w") or die("파일을 열 수 없습니다！");
            $data = $item["content"]; // 사용자가 textarea에서 전달한 내용을 
            fwrite($fp, $data); // 파일로 씀.
            fclose($fp); 

            echo '이메일 설정이 저장되었습니다.';
        
        // 이메일 직접 발송의 경우
        }else if($mode === 'manual'){
            $result = connect('select * from email');
            $address = '';
            $password = '';
            
            // 디비에 저장되어있는 이메일, 비밀번호 가져옴.
            while($row = mysqli_fetch_array($result)){
                $address = $row["address"];
                $password = $row["password"];
            }

            $mailType = explode('@', $address)[1];

            // json_decode를 통해 반환된 $item에서 필요한 값들 할당
            $receiver = $item["receiver"]; // 현재 1명에게만 발송하도록 
            $title = $item["title"];
            $content = $item["content"];
            $file = ''; // 첨부파일 기능을 위한 $file 변수
            
            // sendMail 호출
            $result = sendMail($mailType, $address , $password, $receiver, $title, $content, $file);
            
            
            echo $result;
        };
    // email info update
    }else if(isset($_POST["mode"])){
        $sql = "update email set address = '".$_POST["address"]."', password = '".$_POST["password"]."'";
        $result = connect($sql);
        echo '이메일 정보가 변경되었습니다.';
    }

    // 파일로 저장된 자동 이메일 양식을 불러오는 함수.
    function getEmailForm(){
        $fp = fopen("admin_email_form.txt", "r") or die("파일을 열 수 없습니다！");
        $form = '';
        while( !feof($fp) ) {
            $form = $form.fgets($fp);
        }
        fclose($fp);

        return $form;
    }

    // 디비 테이블에 저장된 email info를 반환하는 함수.
    function getEmailInfo(){
        $result = connect('select * from email');
        $arr = '';

        while($row = mysqli_fetch_array($result)){
            $arr = array("address" => $row["address"], "title" => $row["title"], "password" => $row["password"]);
        }

        return $arr;
    }

    // 이메일을 보내는 함수.
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
            
            // 이메일 발송 내역 저장.
            insertEmailHistory($receiver, $title, $content);

            return "1"; // 전송성공인 경우, 마지막에 1추가
            
            } catch (Exception $e) {
                //$arr = array("msg" => "메일 발송에 실패하였습니다.", "error_info" => ($mail -> ErrorInfo));
                return "0"; // 전송 실패의 경우, 마지막에 0추가
            }
    }

    function insertEmailHistory($receiver, $title, $content){
        $sql ="insert into email_history set receiver = '".$receiver."', content = '".$content."', title = '".$title."'";
        $result = connect($sql);
    }
?>