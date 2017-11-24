<?php
header('Content-Type: text/html; charset=utf-8');

function mailer($emailNhan,$tenNhan,$subject,$content){
    require('mailer/src/PHPMailer.php');

    $mail = new PHPMailer(true);    
    $mail->CharSet = "UTF-8";                          // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'vinhtvg1207@gmail.com';                 // SMTP username
        $mail->Password = 'cassiopeia0706';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;

        //$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        //$mail->Port = 465;                                     // TCP port to connect to

        //Recipients
        $mail->setFrom('vinhtvg1207@gmail.com', 'Tên người gửi');
        $mail->addAddress($emailNhan, $tenNhan);     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('vinhtvg1207@gmail.com', 'Reply....');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        
        $mail->Body    = $content;
        //$mail->AltBody = 'Đây là nội dung thư, chào bạn.............';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}
