<?php
/**
 * Created by PhpStorm.
 * User: mhmdbackershehadi
 * Date: 7/9/18
 * Time: 9:42 PM
 */

namespace bitcko\mailer;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class BitckoMailer
{

    public $SMTPDebug;
    public $isSMTP = false;
    public $Host;
    public $SMTPAuth = false;
    public $Username;
    public $Password;
    public $SMTPSecure ;
    public $Port ;

    public $isHTML = true;



    public  function mail($params){
        $mail = new PHPMailer(true);  
        try {

            //Server settings
            if($this->SMTPDebug){
                $mail->SMTPDebug = $this->SMTPDebug;               // Enable verbose debug output
            }

            if ($this->isSMTP) {

                $mail->isSMTP();                            // Set mailer to use SMTP
            }
            if ($this->Host) {

                $mail->Host = $this->Host;                    // Specify main and backup SMTP servers
            }
            if ($this->SMTPAuth) {

                $mail->SMTPAuth = $this->SMTPAuth;            // Enable SMTP authentication
            }
            if ($this->Username) {

                $mail->Username = $this->Username;            // SMTP username
            }
            if ($this->Password) {

                $mail->Password = $this->Password;            // SMTP password
            }
            if ($this->SMTPSecure) {

                $mail->SMTPSecure = $this->SMTPSecure;        // Enable TLS encryption, `ssl` also accepted
            }
            if ($this->Port) {

                $mail->Port = $this->Port;                    // TCP port to connect to
            }


            //Recipients
            $mail->setFrom($params['from']['address'], $params['from']['name']);

            foreach ($params['addresses'] as $address) {
                $mail->addAddress($address['address'], $address['name']);
            }

            if (isset($params['addReplyTo'])) {
                foreach ($params['addReplyTo'] as $replyTo) {
                    $mail->addReplyTo($replyTo['address'], $replyTo['information']);

                }
            }

            if (isset($params['cc'])) {
                foreach ($params['cc'] as $cc) {
                    $mail->addCC($cc);
                }
            }

            if (isset($params['bcc'])) {
                foreach ($params['bcc'] as $bcc) {
                    $mail->addBCC($bcc);
                }
            }


            if (isset($params['attachments'])) {
                foreach ($params['attachments'] as $attachment) {
                    $mail->addAttachment($attachment['path'], $attachment['name']);
                }
            }


                //Content
                $mail->isHTML($this->isHTML);
                if (isset($params['subject'])) {
                    $mail->Subject = $params['subject'];
                }
                $mail->Body = $params['body'];
                if (isset($params['altBody'])) {
                    $mail->AltBody = $params['altBody'];
                }


                if ($mail->send()) {
                    return true;
                }
                return $mail->ErrorInfo;

            }catch(Exception $e) {

                \Yii::$app->response->data = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;

            }


 }


}


