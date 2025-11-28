<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = substr(trim($_POST['name'] ?? ''), 0, 200);
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $message = substr(trim($_POST['message'] ?? ''), 0, 2000);

    if (!$name || !$email || !$message) {
        http_response_code(400);
        echo "Please complete all fields.";
        exit;
    }

    $to = "you@yourdomain.com"; // <-- change to your email
    $subject = "New message from portfolio contact form";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message\n";
    $headers = "From: $name <$email>\r\nReply-To: $email\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you — message sent.";
    } else {
        http_response_code(500);
        echo "Sorry, message failed to send.";
    }
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
?>
