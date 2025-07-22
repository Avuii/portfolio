<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobieranie danych z formularza
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $subject = $_POST['Subject'];
    $message = $_POST['Message'];

    $mail = new PHPMailer(true);

    try {
        // Ustawienia serwera SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kstanczyk.contactme@gmail.com';
        $mail->Password = getenv('mail_password');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Ustawienia nadawcy i odbiorcy
        $mail->setFrom($email, $name);
        $mail->addAddress('kstanczyk.contactme@gmail.com', 'Katarzyna Stanczyk'); // Odbiorca (Twój adres e-mail)

        // Treść wiadomości
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "<strong>Name:</strong> $name<br><strong>Email:</strong> $email<br><strong>Subject:</strong> $subject<br><strong>Message:</strong><br>$message";

        // Wysłanie wiadomości
        $mail->send();
        echo "Message has been sent!";
    } catch (Exception $e) {
        echo "Message could not be sent. Error: {$mail->ErrorInfo}";
    }
}
?>
