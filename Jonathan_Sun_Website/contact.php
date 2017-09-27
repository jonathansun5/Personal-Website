<?php
   if (isset($_POST["submit"])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $messagesubject = $_POST['messagesubject'];
      $message = $_POST['message'];
      $from = $name . ' <' . $email . '>';
      $to = 'jonathansun5@gmail.com'; 
      $subject = 'Message via Personal Website from ' . $name;

      $message = 'Name: ' . $name . '<br/><br/>
             Email: ' . $email . '<br/><br/>
             Subject: ' . $messagesubject . '<br/><br/>
             Message: ' . nl2br($message) . '<br/>';
 
      // Check if name has been entered
      if (!$_POST['name']) {
         $errName = 'Please enter your name.';
      }
      
      // Check if email has been entered and is valid
      if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
         $errEmail = 'Please enter a valid email address.';
      }
      
      //Check if message has been entered
      if (!$_POST['subject']) {
         $errSubject = 'Please enter your subject.';
      }

      //Check if message has been entered
      if (!$_POST['message']) {
         $errMessage = 'Please enter your message.';
      }

// If there are no errors, send the email
if (!$errName && !$errEmail && !$errSubject && !$errMessage) {
   if (mail ($to, $subject, $body, $from)) {
      $result='<div class="alert alert-success">Thank You! I will be in touch</div>';
   } else {
      $result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
   }
}
   }
?>
