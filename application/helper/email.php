<?php require "application/views/layouts/header.php"; ?>
    <div class="container">
        <?php
        if(isset($_POST["submit"])) {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $subject = $_POST["subject"];
            $message = $_POST["message"];
            $message = wordwrap($message, 70, "\r\n");
            $recipient = "stickershock2@gmail.com";
            $mailheader = "From: $email \r\n";
            $formcontent = "From: $name \r\nMessage: $message \r\n";
            if ($_POST["ordernumber"] != "") {
                $ordernumber = $_POST["ordernumber"];
                $formcontent .= "Order Number: $ordernumber";
            }
            $mail = mail($recipient, $subject, $formcontent, $mailheader);
            if($mail) {
                echo "<p>Thank you for contacting the Sticker Shock team! </p>";
                echo "<p>We will be in touch as soon as possible.</p>";
            }
            else
                echo "<p>There was an error sending your email. We apologize for any inconvenience.</p>";
        }
        ?>
    </div>
<?php require "application/views/layouts/footer.php"; ?>

