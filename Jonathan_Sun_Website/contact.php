<?php
//Retrieve form data. 
//GET - user submitted data using AJAX
//POST - in case user does not support javascript, we'll use POST instead
$name = "";
$email = "";
$age = "";
$comment = "";
$name = !empty($_POST['name']) ? $_POST['name'] : $_GET['name'];
$email = !empty($_POST['email']) ? $_POST['email'] : $_GET['email'];
$age = !empty($_POST['age']) ? $_POST['age'] : $_GET['age'];
$comment = !empty($_POST['comment']) ? $_POST['comment'] : $_GET['comment'];
if (!empty($_POST ["age"])) {
   if ($_POST ["age"] != "") {
      echo "Your form submission has an error.";
      exit;
   } else {
      echo $_POST ["age"];
   }
} else {
   echo "its empty";
}
// $name = isset($_GET['name']) ? $_GET['name'] : $_POST['name'];
// $email = isset($_GET['email']) ?$_GET['email'] : $_POST['email'];
// $message = isset($_GET['message']) ?$_GET['message'] : $_POST['message'];
// $comment = isset($_GET['comment']) ?$_GET['comment'] : $_POST['comment'];
$errors = array();
//flag to indicate which method it uses. If POST set it to 1
if ($_POST) $post=1;
//Simple server side validation for POST data, of course, you should validate the email
if (!$name) $errors[count($errors)] = 'Please enter your name.';
if (!$email) $errors[count($errors)] = 'Please enter your email.'; 
if (!$age) $errors[count($errors)] = 'Please enter your age subject.'; 
if (!$comment) $errors[count($errors)] = 'Please enter your message.'; 
//if the errors array is empty, send the mail
if (!$errors) {
   //recipient - replace your email here
   $to1 = 'jonathansun5@gmail.com';
   // $to2 = 'jonathansun5@berkeley.edu';
   //sender - from the form
   $from = $name . ' <' . $email . '>';
   
   //subject and the html message
   $subject = 'Message via Personal Website from ' . $name; 
   $message = 'Name: ' . $name . '<br/><br/>
             Email: ' . $email . '<br/><br/> 
             Subject: ' . $message . '<br/><br/>    
             Message: ' . nl2br($comment) . '<br/>';
   //send the mail
   $result1 = sendmail($to1, $subject, $message, $from);
   // $result2 = sendmail($to2, $subject, $message, $from);
   //if POST was used, display the message straight away
   if ($_POST) {
      if ($result1) echo 'Thank you! We have received your message.';
      else echo 'Sorry, unexpected error. Please try again later';
      
   //else if GET was used, return the boolean value so that 
   //ajax script can react accordingly
   //1 means success, 0 means failed
   } else {
      echo $result1;
      // echo $result2;  
   }
//if the errors array has values
} else {
   //display the errors message
   for ($i=0; $i<count($errors); $i++) echo $errors[$i] . '<br/>';
   echo '<a href="index.html">Back</a>';
   exit;
}
//Simple mail function with HTML header
function sendmail($to, $subject, $message, $from) {
   $headers = "MIME-Version: 1.0" . "\r\n";
   $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
   $headers .= 'From: ' . $from . "\r\n";
   
   $result = mail($to,$subject,$message,$headers);
   
   if ($result) return 1;
   else return 0;
}
?>