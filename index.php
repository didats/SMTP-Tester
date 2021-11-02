<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__."/vendor/autoload.php";
require __DIR__."/src/Input.php";

$message = "";
$status = "warning";
if(isset($_POST['submit'])) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $_POST['mailhost'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $_POST['mailuser'];                     //SMTP username
        $mail->Password   = $_POST['mailpassword'];                               //SMTP password
        $mail->SMTPSecure = $_POST['encryption']; //PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = $_POST['mailport'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom($_POST['mailuser'], 'Test Mailer');
        $mail->addAddress($_POST['mailto']);     //Add a recipient
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email sent using the test SMTP at '.date("d, M Y H:i");
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        $message = 'Message has been sent';
        $status = "success";
    } catch (Exception $e) {
        $status = "danger";
        $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <br />
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-6">
                <h1>SMTP Tester</h1>
                <p>It such pain to test out SMTP that someone gave you, and you need to do the script to test it out. This one will give you ability to test it out without doing any single code.</p>
                <br />
                <?php
                if(strlen($message) > 0) {
                    ?>
                    <div class="alert alert-<?= $status ?>" role="alert">
                        <?= $message ?>
                    </div>
                    <?php
                }
                ?>
                <div class="mb-3">
                    <label class="form-label">Type:</label>
                    <select name="type" class="form-control" onchange="changeType(this.value)">
                    <option value="custom">Custom</option>    
                    <option value="gmail">Gmail</option>
                    </select>    
                </div>
                

                <form name="" method="post" action="" autocomplete="off">
                    <input type="hidden" name="autocomplete" autocomplete="false" />
                    <?php
                        $inputs = [
                            new Input("email", "Send email to", "Enter who receive the email", "mailto"),
                            new Input("text", "Mail Host", "Email SMTP Host", "mailhost"),
                            new Input("number", "Mail Port", "Email SMTP Port", "mailport"),
                            new Input("text", "Mail Encryption", "Email SMTP Encryption", "encryption"),
                            new Input("email", "Username", "Email SMTP User", "mailuser"),
                            new Input("text", "Password", "Email SMTP Password", "mailpassword")
                        ];
                        
                        foreach($inputs as $input) {
                            ?>
                            <div class="mb-3">
                                 <label for="<?= $input->name ?>" class="form-label"><?= $input->label ?>:</label>
                                 <input value="<?= Input::fromPost($input->name) ?>" type="<?= $input->type ?>"  name="<?= $input->name ?>" class="form-control" id="<?= $input->name ?>" placeholder="<?= $input->placeholder ?>" />
                            </div>
                            <?php 
                        }
                    ?>
                    <button name="submit" type="submit" class="btn btn-lg btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <br />
    </div>
    <script type="text/javascript">
        function changeType(val) {
            var host = ""
            var port = ""
            var encryption = ""

            if (val == "gmail") {
                host = "smtp.gmail.com"
                port = "465"
                encryption = "TLS"
            }

            console.log(document.getElementById("mailhost"))

            document.getElementById("mailhost").value = host
            document.getElementById("mailport").value = port
            document.getElementById("encryption").value = encryption
        }
    </script>
</body>

</html>