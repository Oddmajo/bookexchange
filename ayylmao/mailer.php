<?php
    if (isset($_GET["sendmail"])) {
        unset($_GET["sendmail"]);

        date_default_timezone_set('Etc/UTC');

        $email = $_POST["email"];
        $name = $_POST["name"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        require 'PHPMailer/PHPMailerAutoload.php';

        //Create a new PHPMailer instance
        $mail = new PHPMailer();

        //Tell PHPMailer to use SMTP
        $mail->IsSMTP();

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 2;

        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "joe.sorgea@gmail.com";

        //Password to use for SMTP authentication
        $mail->Password = "hPotter32";

        //Set who the message is to be sent from
        $mail->SetFrom('joe.sorgea@gmail.com', 'Elite Level Prospects');

        //Set an alternative reply-to address
        //$mail->addReplyTo('replyto@example.com', 'First Last');

        //Set who the message is to be sent to
        $mail->AddAddress($email, $name);

        //Set the subject line
        $mail->Subject = 'PHPMailer GMail SMTP test';

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->MsgHTML(sprintf(file_get_contents("coach-mail-template.html"), $name, $username, $password));

        //send the message, check for errors
        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    }
?>

<body>
    <form action="?sendmail=1" method="post">
        Email:<br>
        <input type="text" name="email" value="cbirdoes@yahoo.com"><br>
        Name:<br>
        <input type="text" name="name" value="Cory Birdoes"><br>
        Username:<br>
        <input type="text" name="username" value="cbirdoes"><br>
        Password:<br>
        <input type="text" name="password" value="u7\uHc9qRg*p5G`Y"><br>
        <input type="submit" value="Send Email">
    </form>
</body>
