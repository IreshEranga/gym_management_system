<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer and autoload the classes
require 'vendor/autoload.php'; // Adjust path based on where PHPMailer is located

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);

    // Instantiate PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP(); // Use SMTP
        $mail->Host = 'smtp.gmail.com'; // Use Gmail SMTP server or other provider
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'your-email@gmail.com'; // Your email address
        $mail->Password = 'your-email-password'; // Your email password or app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS encryption
        $mail->Port = 587; // Port for Gmail SMTP

        // Recipients
        $mail->setFrom('your-email@gmail.com', 'Power Fit'); // Sender's email and name
        $mail->addAddress('recipient-email@example.com'); // Add recipient's email address (e.g., your email)

        // Content
        $mail->isHTML(true); // Send HTML email
        $mail->Subject = $subject; // Set the subject
        $mail->Body    = "Name: $name<br>Email: $email<br>Subject: $subject<br>Message:<br>$message"; // Formatted message

        // Send the email
        $mail->send();

        // Display success message
        echo "<script>alert('Message sent successfully!'); window.location.href='../../index.html';</script>";
    } catch (Exception $e) {
        // If there's an error, display an error message
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}'); window.location.href='../../index.html';</script>";
    }
}
?>
