<?php
    session_start();
    $user = $_SESSION['user'];
?>

<?php
    print_r($user['id']);
?>