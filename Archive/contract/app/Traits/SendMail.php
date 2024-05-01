<?php



namespace App\Traits;



use Illuminate\Http\Request;

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;



trait SendMail {



    /**

     * @param Request $request

     * @return $this|false|string

     */

    public function fire($to,$subject,$body,$attachment=[]) {



        try {

            $mail = new PHPMailer;     // Passing `true` enables exceptions

            // Email server settings

            $mail->SMTPDebug = 0;

            $mail->isSMTP();

            $mail->Host = 'smtp.office365.com';             //  smtp host

           // $mail->Host = 'localhost'; 

            $mail->SMTPAuth = true;

            //$mail->SMTPAuth = false;

            //$mail->SMTPAutoTLS = false;

            $mail->Username = 'ciaran@createmycontract.com';   //  sender username

            $mail->Password = 'Summer2233##';       // sender password

            $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls

            //$mail->SMTPSecure = 'STARTTLS';                  // encryption - ssl/tls

            

            $mail->Port = 587;                          // port - 587/465

            //$mail->Port = 25;                          // port - 587/465



            $mail->setfrom('ciaran@createmycontract.com', 'Create My Contract');

            //$mail->addaddress($to);
            if(is_array($to)){
                foreach($to as $mailData){
                    $mail->addaddress($mailData);
                }
            }else{
                $mail->addaddress($to);
            }

            



            if(!empty($attachment)) {

                for ($i=0; $i < count($attachment); $i++) {

                    $mail->addAttachment($attachment[$i], '');

                }

                

               // $mail->addAttachment($attachment, '');

            }





            $mail->isHTML(true);                // Set email content format to HTML



            $mail->Subject = $subject;

            $mail->Body    = $body;

            // $mail->Body = view('emails.contact_us_mail', $data)->render();

            // $mail->AltBody = plain text version of email body;



            if( !$mail->send() ) {

                return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);

            }

            

            else {

                return back()->with("success", "Email has been sent.");

            }



        } catch (\Exception $e) {

             return back()->with('error',$e->getMessage());

        }



    }



}
