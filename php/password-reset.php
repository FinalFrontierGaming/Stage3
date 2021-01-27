<?php 

include 'C:\Bitnami\wampstack-8.0.1-0\apache2\htdocs\Konstellation\dbconn.php';

if(isset($_POST['reset-password-email']))
$email =  filter_var($_POST['reset-password-email'], FILTER_SANITIZE_STRING);
print $email;
json_decode($email);

$query = "SELECT * FROM roster WHERE email = '$email'" ;
$result = $backend_conn->query($query);
//Setup Expiration Time
$currentTime = time();
$hourAmount = 2;
$secondsAmount = $hourAmount * (60 * 60);
$offsetTime = $currentTime + $secondsAmount;

$expirationTime = date("m-d-Y H:i", $offsetTime);

if ($result->num_rows == 1) {
    //print $result;
    //Email Setup
    $ResetToken = bin2hex(random_bytes(20));
    $to = $email;
    $subject = 'Your Password Reset Request';
    $message = 'Hey there, you are receiving this email because you requested a reset of your password for Final Frontier Gaming. Please click (or copy and paste into your browser) this link to reset your password. http://finalfrontiergaming.com/reset-password?token=' . $ResetToken . 'Please note that this password reset link and token will expire two (2) hours from now at' . $expirationTime;
    $headers = array(
        'From' => 'noreply@finalfrontiergaming.com',
        'Reply-To' => 'noreply@finalfrontiergaming.com',
        'X-Mailer' => 'PHP/' . phpversion()
    );
    //Insert Token into DB
    $tokeninsert = "INSERT INTO stage3_resets (email, token, expiration) VALUES ( '$email' , '$ResetToken', '$expirationTime')";
    $tokenresult = $backend_conn->query($tokeninsert);
        if($tokenresult) {
            mail($to, $subject, $message, $headers);
        } else {
            print "Query Failed: " . $tokeninsert;
        }
}
else {
 http_response_code(400);
}

?>