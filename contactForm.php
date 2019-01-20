<?php
header('Refresh: 0; URL=https://andrewchen349.github.io/');

   function clean_string($string) {
    $bad = array("content-type","bcc:","to:","cc:","href");
    return str_replace($bad,"",$string);
  }
  function died($error) {
      echo '<script type="text/javascript">alert("' . $error . '")</script>';

    }


if (isset($_POST['email'])) {
  // EDIT THE 2 LINES BELOW AS REQUIRED
  $email_to = "vineet.malhotra125@gmail.com";
  $email_subject = "Message From Your Site";


  // validation expected data exists
  if(!isset($_POST['first_name']) ||
    !isset($_POST['last_name']) ||
    !isset($_POST['email']) ||
    !isset($_POST['comments'])) {

  }
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $comments = $_POST['comments'];

  $error_message = "";

  if(!filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL)) {
    $error_message .= 'The Email Address you entered is invalid.\n';
  }

  $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered is invalid.\n';
  }

  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'The Last Name you entered is invalid.\n';
  }

  if(strlen($comments) < 2) {
    $error_message .= 'Please enter a valid message. \n';
  }

  if(strlen($error_message) > 0) {
    died($error_message);
  }
  else {
    $email_message = "New Message from DodoBot Site:\n\n";


  $email_message .= "First Name: ".clean_string($first_name)."\n";

  $email_message .= "Last Name: ".clean_string($last_name)."\n";

  $email_message .= "Email: ".clean_string($email)."\n";

  $email_message .= "Message: ".clean_string($comments)."\n";

  // create email headers
  $headers = 'From: '.$email."\r\n".
  'Reply-To: '.$email."\r\n" .
  'X-Mailer: PHP/' . phpversion();
  @mail($email_to, $email_subject, $email_message, $headers);

?>

 echo '<script type="text/javascript">alert("Thank you for contacting us. You may expect a reply from us shortly!");</script>' exit ;

<?php

  }
}
?>
