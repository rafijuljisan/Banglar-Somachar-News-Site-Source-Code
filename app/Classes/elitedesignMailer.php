<?php
/**
 * Created by PhpStorm.
 * User: ShaOn
 * Date: 11/29/2018
 * Time: 12:49 AM
 */

namespace App\Classes;

use App\Models\Order;
use App\Models\EmailTemplate;
use App\Models\GeneralSettings; // Corrected capitalization here
use PDF;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Str;

class elitedesignMailer
{

    public $mail;
    public $gs;

    public function __construct()
    {
        $this->gs = GeneralSettings::findOrFail(1);

        $this->mail = new PHPMailer(true);

        // FORCE SMTP ON (Ignore Database)
        // if($this->gs->is_smtp == 1){  <-- DELETE OR COMMENT THIS LINE

            $this->mail->isSMTP();                          
            
            // HARDCODED CREDENTIALS FROM YOUR .ENV
            $this->mail->Host       = 'server900.web-hosting.com'; 
            $this->mail->SMTPAuth   = true;                 
            $this->mail->Username   = 'noreply@banglarsomachar.com';   
            $this->mail->Password   = '!Lw])qr7gH;o';   
            $this->mail->SMTPSecure = 'ssl';      
            $this->mail->Port       = 465; 

        // } <-- DELETE OR COMMENT THIS CLOSING BRACE
    }


    public function sendAutoMail(array $mailData)
    {

        $temp = EmailTemplate::where('email_type','=',$mailData['type'])->first();

        try{

            $body = preg_replace("/{customer_name}/", $mailData['cname'] ,$temp->email_body);
            $body = preg_replace("/{order_amount}/", $mailData['oamount'] ,$body);
            $body = preg_replace("/{admin_name}/", $mailData['aname'] ,$body);
            $body = preg_replace("/{admin_email}/", $mailData['aemail'] ,$body);
            $body = preg_replace("/{order_number}/", $mailData['onumber'] ,$body);
            $body = preg_replace("/{website_title}/", $this->gs->title ,$body);

            //Recipients
            $this->mail->setFrom($this->gs->from_email, $this->gs->from_name);
            $this->mail->addAddress($mailData['to']);     // Add a recipient

            // Content
            $this->mail->isHTML(true);  

            $this->mail->Subject = $temp->email_subject; 

            $this->mail->Body = $body; 

            $this->mail->send();

        }
        catch (Exception $e){

        }

        return true;

    }

    public function sendCustomMail(array $mailData)
    {
    //   return $mailData;
        try{

            //Recipients
            $this->mail->setFrom($this->gs->from_email, $this->gs->from_name);
            $this->mail->addAddress($mailData['to']);     // Add a recipient

            // Content
            $this->mail->isHTML(true);  

            $this->mail->Subject = $mailData['subject']; 

            $this->mail->Body = $mailData['body']; 

            $this->mail->send();

        }
        catch (Exception $e){
            // You can uncomment this if you need to debug mail errors specifically
            // dd($e->getMessage());
        }

        return true;
    }

}