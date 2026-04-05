<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'floristymuse@gmail.com';    // Ganti dengan email kamu
        $mail->Password = 'umty ovpq zerx pevr';        // Ganti dengan App Password Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($email, $name);
        $mail->addAddress('floristymuse@gmail.com');   // Email tujuan

        $mail->isHTML(true);
        $mail->Subject = 'Pesan dari kontak website';
        $mail->Body = "Nama: $name <br>Email: $email<br>Pesan: $message";

        $mail->send();

        header('Location: home.html');
        exit;
    } catch (Exception $e) {
        echo "Gagal mengirim email. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Metode pengiriman salah.";
}
