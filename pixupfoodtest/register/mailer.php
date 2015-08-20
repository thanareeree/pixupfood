<?php



                require './PHPMailer/PHPMailerAutoload.php';
                $mail = new PHPMailer;

//Tell PHPMailer to use SMTP
                $mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
                $mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
                $mail->Debugoutput = 'html';

//Set the hostname of the mail server
                $mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
                $mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
                $mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
                $mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
                $mail->Username = "peepolike@gmail.com";

//Password to use for SMTP authentication
                $mail->Password = "07052537";

//Set who the message is to be sent from
                $mail->setFrom('technomann11@gmail.com', 'Pixupfood');

//Set an alternative reply-to address
                $mail->addReplyTo('technomann11@gmail.com', 'Pixupfood');

//Set who the message is to be sent to
                $mail->addAddress($row["email"]);

//Set the subject line
                $mail->Subject = 'Test Send OTP Password';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
                $mail->Body = 'Your one time password is : ' . $row["password"];
                $mail->isHTML(true);

                if (!$mail->send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                } else {
                    echo "Message sent!";
                }


//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
           


        
        
        
        
        


