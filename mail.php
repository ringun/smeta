<?php
$config = require_once('config.php');
if(!isset($_POST['name']) or !isset($_POST['phone']))
    return;

$name = $_POST['name'];
$phone = $_POST['phone'];

if(strlen($name) > 100 or strlen($phone) > 100) {
    echo 0;
    return;
}

$name = htmlspecialchars($name);
$phone = htmlspecialchars($phone);

$to = implode(',', array_map(function($item){ return $item['email']; }, $config['recipients']));
$header = "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/plain; charset=utf-8\r\n";
$header .= "Content-Transfer-Encoding: 8bit\r\n";
$header .= "From: <grandsmeta03.ru>\r\n";
$subject = "На вашем сайте пользователь оставил заявку.";
$message = "\nИмя автора: " . $name . "\nТелефон: " . $phone;
$data = mail($to, $subject, $message, $header);

if($data)
    echo 1;
else
    echo 0;