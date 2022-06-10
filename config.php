<?php
    $http_host = $_SERVER['HTTP_HOST'];
    $request_uri = $_SERVER['REQUEST_URI'];
    $url = 'http://' . $http_host . $request_uri;
    
    define('PATH',$url);
?>
