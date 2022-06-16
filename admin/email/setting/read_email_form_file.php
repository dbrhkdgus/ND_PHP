<?php
    function getEmailForm(){
        $fp = fopen("admin_email_form.txt", "r") or die("파일을 열 수 없습니다！");
        $form = '';
        while( !feof($fp) ) {
            $form = $form.fgets($fp);
        }
        fclose($fp);

        return $form;
    }
?>