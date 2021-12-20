<?php

if (isset($_POST['Reset-request-submit'])) {
  $Selector = bin2hex(random_bytes(8));
  $Token = random_bytes(32);

  $url = "mypcgn.com/create-new-password.php?selector=" .$Selector."&validator=" .bin2hex($Token);

  $expires = date("U") + 3600;
  require 'dbh.inc.php';

  $userEmail = $_POST["Email"];
  $sql5 = "SELECT * FROM dns079set WHERE maga90e=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql5)) {
    header  ("Location: ../reset-Password.php?error=sqlerror1");
    exit();
  }
  else {
    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultChe = mysqli_stmt_num_rows($stmt);
    if ($resultChe == 1) {
      require 'dbh.inc.php';
      $sql6 = "DELETE FROM pure9pwd WHERE ereset80pwd=?";
      $stmt1 = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt1, $sql6)) {
        header  ("Location: ../reset-Password.php?error=sqlerror2");
        exit();
      } else {
        mysqli_stmt_bind_param($stmt1, "s", $userEmail);
        mysqli_stmt_execute($stmt1);
      }
      $sql = "INSERT INTO pure9pwd (ereset80pwd, pwd76serest, dala90pwd, pwd79bunkure) VALUES (?,?,?,?);";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt,$sql)) {
        header  ("Location: ../reset-Password.php?error=sqlerror3");
        exit();
      } else {
        $hashedToken = password_hash($Token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $Selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
      }
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
      
      $to = $userEmail;

      $subject = 'Reset Your Password PCG CITY Please Do not share';

      $message = '<p>We have Received a password reset request. The Link to reset Your password is below, IF YOU DID NOT MAKE THIS REQUEST, You Can Ignore this email as it expires in a while</p>';

      $message .= '<p>Here is Your Password reset link: </br>';
      $message .= '<a href="' .$url .'">' .$url .'</a></p>';

      $headers = "From: PCGCITY <no-reply@pcgn.com>\r\n";
      $headers .= "Reply-To: Uphysician@gmail.com\r\n";
      $headers .= "Content-type: text/html\r\n";

      mail($to, $subject, $message, $headers);
      header("Location: ../reset-Password.php?S8665=S56325");
      exit();
    }
    else {
      header("Location: ../reset-Password.php?error=NoEmail&Email=" .$userEmail);
      exit();
    }
  }
}
else {
  header('Location: ../login.php');
}
