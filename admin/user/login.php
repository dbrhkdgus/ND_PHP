<?php
$conn = mysqli_connect('192.168.0.65', 'php', 'php', 'php_project');
$filtered = array(
    'id' => mysqli_real_escape_string($conn, $_POST['id']),
    'password' => mysqli_real_escape_string($conn, $_POST['password'])
);

$sql = "
    SELECT * FROM user WHERE id = ''
";

?>