<?php

include '../register/PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "system@chakree.me";
$mail->Password = "IT5510IT5510";
$mail->setFrom('peepo_like@gmail.com', 'Pixupfood');
$mail->addAddress("peepolike@gmail.com");
$mail->Subject = 'Test Send OTP Password';
$mail->Body = 'Your one time password is : ' . $row["password"];
$mail->isHTML(true);

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}