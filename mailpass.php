public function sendMail($email, $company, $location, $startAt, $endAt, $date, $userId,$duration)
{
    $to = $email; /* '. ',';  separated by comma for another email (useful if you want to keep records(sending to yourself))*/;
    $subject = 'INSERT_SUBJECT_HERE';

    $bound_text = "----*%$!$%*";
    $bound = "--".$bound_text."\r\n";
    $bound_last = "--".$bound_text."--\r\n";

    $headers = "From: noreply@somewhere.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n" .
            "Content-Type: multipart/mixed; boundary=\"$bound_text\""."\r\n" ;

    $message = " you may wish to enable your email program to accept HTML \r\n".
            $bound;

    $message .=
    'Content-Type: text/html; charset=UTF-8'."\r\n".
    'Content-Transfer-Encoding: 7bit'."\r\n\r\n".
    '
<!-- here is where you format the email to what you need, using html you can use whatever style you want (including the use of images)-->
            <BODY BGCOLOR="White">
            <body>
            <div Style="align:center;">
            <p>
            <img src="IMAGE_URL" alt= "IMAGE_NAME">
            </p>
            </div>
            </br>
            <div style=" height="40" align="left">

            <font size="3" color="#000000" style="text-decoration:none;font-family:Lato light">
            <div class="info" Style="align:left;">

            <p>information here<!--(im sure you know how to write html ;))--></p>

            <br>

            <p>Location:  '.$location.' <!-- $location is the variable you wish to insert as is $date etc --> </p>

            <p>Date:      '.$date.'      </p>

            <p>Time:      '.$startAt.'   </p>

            <p>Duration:  '.$duration.'  </p>

            <p>Company:   '.$company.'   </p>

                '. /* <p>Charge:    '.$charge.'    </p> */'
            <br>

                <p>Reference Number: '.$userId.'</p>

                            </div>

            </br>
            <p>-----------------------------------------------------------------------------------------------------------------</p>
            </br>
            <p>( This is an automated message, please do not reply to this message, if you have any queries please contact someone@someemail.com )</p>
            </font>
            </div>
            </body>
        '."\n\n".
                                                                    $bound_last;

    $sent = mail($to, $subject, $message, $headers); // finally sending the email


}




<?php
    $email =$_POST['email'];

    public function sendMail($email, $userId)
{
   $to = $email;
$subject = 'Password Reset';

$bound_text = "----*%$!$%*";
$bound = "--".$bound_text."\r\n";
$bound_last = "--".$bound_text."--\r\n";

$headers = "From: noreply@somewhere.com\r\n";
$headers .= "MIME-Version: 1.0\r\n" .
        "Content-Type: multipart/mixed; boundary=\"$bound_text\""."\r\n" ;

$message = " you may wish to enable your email program to accept HTML \r\n".
        $bound;

    $message .=
  'Content-Type: text/html; charset=UTF-8'."\r\n".
  'Content-Transfer-Encoding: 7bit'."\r\n\r\n".
  '

        <BODY BGCOLOR="White">
        <body>

        </br>
        <div style=" height="40" align="left">

        <font size="3" color="#000000" style="text-decoration:none;font-family:Lato light">
        <div class="info" Style="align:left;">

        <p>place link here for password reset</p>

         <p>Reference Number: '.$userId.'</p>

                        </div>

        </br>
        <p>-----------------------------------------------------------------------------------------------------------------</p>
        </br>
        <p>( This is an automated message, please do not reply to this message, if you have any queries please contact someone@someemail.com )</p>
        </font>
        </div>
        </body>
    '."\n\n".
                                                                $bound_last;

$sent = mail($to, $subject, $message, $headers); // finally sending the email


}


    function createRandomPassword() {
    $chars = "ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789";
    $i = 0;
    $pass = '' ;

    while ($i <= 8) {
        $num = mt_rand(0,61);
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
    }

    $pw = createRandomPassword();
    $query = "UPDATE users SET password= SHA1('$pw') WHERE email = '$email' ";
    $result = mysqli_query($link, $query);
if ($result){
$query3 = "SELECT * FROM users where email = '$email'";
$sql = mysqli_query($link, $query3) or die(mysqli_error());  
$rownum = mysqli_num_rows($sql);

if(!$rownum  ) {
   echo "We can not find your email in our records";
    }

    }
   if($result){
   $this->sendMail($email, $userId); /*does it need to be in a class for $this->? or can you call       functions within the php page without?*/
} ?>