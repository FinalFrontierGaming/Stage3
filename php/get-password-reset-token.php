<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include $_SERVER['DOCUMENT_ROOT'].'/Konstellation/dbconn.php';

if(isset($_POST['reset-token']))
if(isset($_POST['reset-password']))
$resetToken = filter_var($_POST['reset-token'], FILTER_SANITIZE_STRING);
$newPassword = filter_var($_POST['reset-password'], FILTER_SANITIZE_STRING);
print $resetToken;

$query = "SELECT * FROM stage3_resets WHERE token = '$resetToken'" ;
$result = $backend_conn->query($query);
while ($row = $result->fetch_assoc()) {
    $expirationTime = $row['expiration'];
}

$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
print $hashedPassword;
$currentDateTime = date('m-d-Y H:i');

if ($result->num_rows == 1) {
    print "step1 done";
    //Email Setup
    $getEmail = "SELECT email, expiration FROM stage3_resets WHERE token = '$resetToken'" ;
    $emailResult = $backend_conn->query($getEmail);
    while ($row = $emailResult->fetch_assoc()) {
        $userEmail = $row['email'];
        $tokenExpiration = $row['expiration'];
        print "FirstDBQ done";
    }

        if ($currentDateTime < $tokenExpiration) {
            print "Date OK!";
            $submitNewPassword = "UPDATE roster SET password = '$hashedPassword' WHERE email = '$userEmail' LIMIT 1";
            $newPasswordResult = $backend_conn->query($submitNewPassword);
                if ($newPasswordResult) {
                    print "Password submitted";
                }
        } else {
            http_response_code(400);
        }
    //$to = $email;
    //$subject = 'Your Password Reset Request';
    //$message = 'Hey there, you are receiving this email because you requested a reset of your password for Final Frontier Gaming. Please click (or copy and paste into your browser) this link to reset your password. http://finalfrontiergaming.com/reset-password?token=' . $ResetToken . 'Please note that this password reset link and token will expire two (2) hours from now at' . $expirationTime;
    //$headers = array(
    //    'From' => 'noreply@finalfrontiergaming.com',
    //    'Reply-To' => 'noreply@finalfrontiergaming.com',
    //    'X-Mailer' => 'PHP/' . phpversion()
    //);
    //Insert Token into DB
    //$tokeninsert = "INSERT INTO stage3_resets (email, token, expiration) VALUES ( '$email' , '$ResetToken', '$expirationTime')";
    //$tokenresult = $backend_conn->query($tokeninsert);
    //    if($tokenresult) {
    //        mail($to, $subject, $message, $headers);
    //    } else {
    //        print "Query Failed: " . $tokeninsert;
    //    }
}
else {
    http_response_code(400);
}

?>