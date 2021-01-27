<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$to = 'Papercut@user.com';
$subject = 'Test Email';
$message = 'This is a test message';
$headers = array(
    'From' => 'noreply@finalfrontiergaming.com',
    'Reply-To' => 'noreply@finalfrontiergaming.com',
    'X-Mailer' => 'PHP/' . phpversion()
);

mail($to, $subject, $message, $headers);
?>

<h1> test </h1>