<?php 
$chek = mail("user@gmail.com", "Testing", "mail from xampp",  "From: sender@gmail.com");


if($chek){
    echo "sent";
}else {
    echo "failed";
}

//-----------------------Using XAMPP on LocalHost------------------------------------
/*
php.ini > [ctrl + f] mail function

[mail function]
;
;
SMTP = smtp.gmail.com
;
smtp_port = 25

;
;
sendmail_form = patelanurag@gmail.com (mail from where emails will be sent)

;

;
sendmail_path = D:\XAMPP\sendmail\sendmail.exe (search for sendmail.exe and add that path here)

D:\XAMPP\sendmail\sendmail.ini > [ctrl + f] smtp_server
smtp_server = smtp.gmail.com

;
smtp_port = 587
    . 
    . 
auth_username =  patelanurag@gmail.com (mail from where emails will be sent)
auth_password = password of App(go to manage your Google Account> enable 2-step Verification & search App passwords> Creat app name ) 
    .  
    .  
force_sender = patelanurag@gmail.com (mail from where emails will be sent) 
*/

$to = "usersmail";
$subjext= "Heading " ;
$msg ="ypur msg"; 
$header = "From: sendersMail";
mail($to,$subject,$txt,$headers)
?>