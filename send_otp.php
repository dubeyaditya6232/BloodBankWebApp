<?php
session_start();
$con=mysqli_connect('localhost','root','','bbms');
$email=$_POST['email'];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
   echo "Invalid";
}
else{
    echo "Valid";
    $otp=rand(100000,999999);
    mysqli_query($con,"INSERT INTO otp_store(email, otp) VALUES('$email','$otp')");
    $content = "Your OTP Verification number is ".$otp;
    $_SESSION['EMAIL']=$email;
    smtp_mailer($email,'OTP Verification',$content);
}

function smtp_mailer($to,$subject,$msg){
    require_once("smtp/class.phpmailer.php");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 1;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'TLS';
    $mail->Host = "smtp.sendgrid.net";
    $mail->Port=587;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Username = "apikey";
    $mail->Password = "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";
    $mail->SetFrom("bbms.bitmesra@gmail.com");
    //$mail->addAttachment("dummy.pdf");
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->AddAddress($to);
    if(!$mail->Send()){
        return 0;
    }
    else{
        return 1;
    }
}
?>