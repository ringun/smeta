<?php
if(!isset($_POST['name']) or !isset($_POST['phone']))
    return;

require_once __DIR__ . '/phpMailer/PHPMailer.php';
$config = require_once __DIR__ . '/config.php';

$name = $_POST['name'];
$phone = $_POST['phone'];

if(count($name) > 100 or count($phone) > 100) {
    echo 0;
    return;
}

$name = htmlspecialchars($name);
$phone = htmlspecialchars($phone);

$mail = new PHPMailer();

// Settings
$mail->IsSMTP();
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->CharSet = 'UTF-8';
$mail->SMTPSecure = 'tls';
$mail->Host       = "ssl://smtp.gmail.com"; // SMTP server example
$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
$mail->Username   = $config['smtp']['email']; // SMTP account username example
$mail->Password   = $config['smtp']['pass'];        // SMTP account password example

// Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Обратный звонок с сайта';
$mail->Body    = "Имя: $name<br>Телефон: $phone";

$mail->SetFrom($config['smtp']['email'], 'grandsmeta03.ru');

foreach($config['recipients'] as $recipient)
    $mail->addAddress($recipient['email'], $recipient['name']);



try{
    if($mail->send())
        echo 1;
    else
        echo 0;
}catch(Exception $e){
    $message = $e->getMessage();
    $a = 1;
    echo 4;
}
