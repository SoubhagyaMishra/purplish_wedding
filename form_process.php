<?php 

// define variables and set to empty values
$name_error = $email_error = $phone_error = $message_error= "";
$name = $email = $phone = $message = $success = "";

//form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["contactName"])) {
    $name_error = "Name is required";
  } else {
    $name = test_input($_POST["contactName"]);

    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $name_error = "Only letters and white space allowed"; 
    }
  }

  if (empty($_POST["contactEmail"])) {
    $email_error = "Email is required";
  } else {
    $email = test_input($_POST["contactEmail"]);

    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_error = "Invalid email format"; 
    }
  }

  if (empty($_POST["contactPhone"])) {
    $pnone_error = "Phone is required";
  } else {
    $phone = test_input($_POST["contactPhone"]);

    // check if phone number is well-formed
    if (!preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $phone)) {
      $phone_error = "Invalid phone number"; 
    }
  }

  if (empty($_POST["contactMessage"])) {
    $message = "";
  } else {
    $message = test_input($_POST["contactMessage"]);
  }
  
  if ($name_error == '' and $email_error == '' and $phone_error == '' and $message_error == '' ){
      $message_body = '';
      unset($_POST['submit']);
      foreach ($_POST as $key => $value){
          $message_body .=  "$key: $value\n";
      }
      
      $to = 'soubhagyamishra8984@gmail.com';
      $subject = 'Contact Form Submit';
      if (mail($to, $subject, $message)){
          $success = "Message sent, thank you for contacting us!";
          $name = $email = $phone = $message= '';
      }
  }
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}