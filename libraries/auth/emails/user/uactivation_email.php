<?php
require_once(dirname(__DIR__).'../PHPMailer/Exception.php');
require_once(dirname(__DIR__).'../PHPMailer/OAuth.php');
require_once(dirname(__DIR__).'../PHPMailer/PHPMailer.php');
require_once(dirname(__DIR__).'../PHPMailer/POP3.php');
require_once(dirname(__DIR__).'../PHPMailer/SMTP.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendUserEmailVerifyMailSecond($u_email,$u_code)
{
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'theecornelius@gmail.com';                     
    $mail->Password   = 'jjfpixorfctnsneo';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   
    $mail->Port       = 587;    
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    ); 
    $mail->setFrom('theecornelius@gmail.com','Pro Services');
    $mail->addAddress("$u_email", "");
    $mail->addReplyTo("corneliuskasokola@gmail.com", "Pro Services");
    $mail->isHTML(true);
    $mail->Subject = "Project Manager";
    $mail->Body    = '
    <body class="s-chaff">
                <div class="content-wrapper" 
                        style="position:absolute; 
                            top:90%;
                            left:50%;
                            transform:translate(-50%,-50%);
                            width:90%;
                            font-family:Times New Roman, Times, serif>                    
                    <p>
                        <h6 style="font-size: medium;font-size: medium;font-weight:lighter;">
                            Hellow.
                            <br>

                        </h6>
                        <span>
                            Thanks for creating an account on our Project Manager.<br>
                            Use the secret code below to verify your account!
                        </span>
                        <br><br><br><br><br>
                        <p style="text-align:center;">
                                <strong>
                                    <span style="background-color: antiquewhite;
                                                padding:2%;">'.$u_code.'</span>
                                </strong>
                        </p>
                        <br><br><br>
                       
                        <br><br><br><br><br>
                        <p style="text-align:center;">
                                <a href="http://'.$_SERVER["SERVER_NAME"].'/auth_email?s_email='.$u_email.'&&s_code='.$u_code.'" class="btn btn-sm btn-primary">Verify Email</a>
                        </p>
                        <br><br><br>
                        <blockquote style="text-align:left;padding-bottom:30%;">
                            Sincerely,<br>
                            Project Manager.<br>
                            <br>Zambia.
                        </blockquote>
                    </p>
                
                </div>
            </body>';  
            if($mail->send()) 
                return true;
            else 
                return false;
}
?>