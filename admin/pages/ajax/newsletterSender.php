<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once('../../../connections.php'); // Path to your database connection script
require_once('../../PHPMailer/src/PHPMailer.php');
require_once('../../PHPMailer/src/Exception.php');
require_once('../../PHPMailer/src/SMTP.php');

$mail = new PHPMailer(true); // Passing `true` enables exceptions

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $subject = $_POST['subjectMail'];
    $message = $_POST['messageMail'];

    // Fetch all active newsletter subscribers
    $query = "SELECT * FROM `newsletter` WHERE unsubscribe = 'no'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sjainpc@gmail.com'; // SMTP username
            $mail->Password = 'fghk khsq gbul bnjk'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Sender info
            $mail->setFrom('no-reply@pcodx.pw', 'EatSmart');

            // Email content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = '<!DOCTYPE html>
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Simple Newsletter</title>
                <link rel="stylesheet" href="https://eatsmart.tiiny.site/email.css">
                <style>
                body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
                table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
                img { -ms-interpolation-mode: bicubic; }
                .pc-font-alt { font-family: Arial, sans-serif !important; }
                @media screen and (max-width: 620px) {
                    .pc-project-container { width: 100% !important; }
                    .pc-w620-width-130 { width: 130px !important; }
                }
                body {
                    margin: 0; padding: 0; background-color: #ffffff;
                }
                .headerTd{
                    background: linear-gradient(15deg, #13547a 0%, #80d0c7 100%); color: #fff; padding: 10px; text-align: center; font-family: Arial, sans-serif; height: 100px;
                }
                .tableMiddle{
                    width: 600px; max-width: 600px; background-color: #ffffff;
                }
                .newsletterHeading{
                    font-family: \'Arial\', sans-serif; color: #40be65; font-size: 18px; font-weight: 700; letter-spacing: 2px;
                }
                .postHeading{
                    font-family: \'Arial\', sans-serif; color: #000; font-size: 36px;
                }
                .postMessage{
                    font-family: \'Arial\', sans-serif; color: #000; font-size: 18px;
                }
                .postButton{
                    background: linear-gradient(15deg, #13547a 0%, #80d0c7 100%); color: #ffffff; padding: 15px; border-radius: 8px; text-decoration: none; font-size: 16px; font-family: \'Arial\', sans-serif; margin-top: 20px; display: inline-block; min-width: 100px;
                }
                .postFooter{
                    background: linear-gradient(15deg, #13547a 0%, #80d0c7 100%); color: #fff; padding: 10px; text-align: center; font-family: Arial, sans-serif;
                }
                .newsletterUnsubcribe{
                    background-color: #333; color: #fff; padding: 10px; text-align: center; font-family: Arial, sans-serif;
                }
                .logoImg{
                    margin: 0 auto 20px auto; display: block; border: 0; outline: none;
                }
                .widthOftble{
                    width: 600px; max-width: 600px;
                }
                .link{
                    color: #ffffff; text-decoration: none;
                }
                </style>
           </head>
            <body >
                <table align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td align="center">
                            <!-- Header -->
                            <table align="center" border="0" cellpadding="0" cellspacing="0" class="pc-project-container widthOftble" >
                                <tr>
                                    <td class="headerTd" >
                                        <img src="https://cloudfilesdm.com/postcards/image-1714829034218.png" alt="logo" class="logoImg" width="156.25" height="31.25" >
                                        Welcome to Our Newsletter
                                    </td>
                                </tr>
                            </table>
                            <!-- Email Content -->
                            <table align="center" border="0" cellpadding="0" cellspacing="0" class="pc-project-container tableMiddle">
                                <tr>
                                    <td align="center" bgcolor="#ffffff" style="padding: 40px;">
                                        <p class="newsletterHeading">NEWSLETTER</p>
                                        <h1 class="postHeading" >'.$subject.'</h1>
                                        <p class="postMessage" >'.$message.'</p>
                                        <a href="https://designmodo.com/postcards" class="postButton">Download manual</a>
                                    </td>
                                </tr>
                            </table>
                            <!-- Footer -->
                            <table align="center" border="0" cellpadding="0" cellspacing="0" class="pc-project-container widthOftble" >
                                <tr>
                                    <td class="postFooter" >
                                        Follow us on social media: <a href="#" class="link"  >Facebook</a>, <a href="#"  class="link">Twitter</a>, <a href="#"  class="link">Instagram</a>
                                    </td>
                                </tr>
                            </table>
                            <!-- Unsubscribe Section -->
                            <table align="center" border="0" cellpadding="0" cellspacing="0" class="pc-project-container widthOftble" >
                                <tr>
                                    <td class="newsletterUnsubcribe" >
                                        <p style="font-size: 14px; margin: 0;">To unsubscribe, click <a href="https://eatsmart.tiiny.site/unsubscribe.html" style="color: #40be65; text-decoration: none;">Here</a>.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
            </html>
            ';

            while ($row = $result->fetch_assoc()) {
                $mail->addAddress($row['email']); // Add a recipient
                $mail->send(); // Send email
                $mail->clearAddresses(); // Clear all addresses for next iteration
            }

            echo '<div class="alert alert-success">Newsletter sent successfully!</div>';
        } catch (Exception $e) {
            echo '<div class="alert alert-danger">Mailer Error: ' . $mail->ErrorInfo . '</div>';
        }
    } else {
        echo '<div class="alert alert-warning">No subscribed emails found.</div>';
    }

    $conn->close(); // Close database connection
} else {
    echo '<div class="alert alert-info">Please submit the form.</div>';
}
?>
