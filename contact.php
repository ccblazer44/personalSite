<?php

// configure
$from = 'Profile Website Visitor';
$sendTo = 'cblazer44@gmail.com';
$subject = 'Someone sent you a message';
$fields = array('name' => 'Name', 'lastname' => 'Last Name', 'phone' => 'Phone', 'email' => 'Email', 'message' => 'Message'); // array variable name => Text to appear in email

$errorMessage = 'There was an error while submitting the form. Please try again later';

// send
header( "refresh:.2;url=/index.html" );
echo '<script language="javascript">';
echo 'alert("I got your message! Thank you!")';
echo '</script>';
try
{
    $emailText = "You have new message from your website\n\n";

    foreach ($_POST as $key => $value) {

        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }

    mail($sendTo, $subject, $emailText, "From: " . $from);

    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
else {
    echo $responseArray['message'];
}

?>
