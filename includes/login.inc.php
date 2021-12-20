<?php

if (isset($_POST['login-submit'])) {
  require 'dbh.inc.php';

  $R2001 = $_POST['Username'];
  $R20088 = $_POST['Password'];

  if (empty($R2001) || empty($R20088)) {
    header("Location: ../login.php?error=EmptyFields");
    exit();
  }
  else {
    $sql1 = "SELECT * FROM dns079set WHERE up30set=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql1)) {
      header("Location: ../login.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $R2001);
      mysqli_stmt_execute($stmt);
      $result1 = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result1)) {
        $PasswordCheck = password_verify($R20088, $row['pks2354dns']);
        if ($PasswordCheck == false) {
          header("Location: ../login.php?error=WrongPassword");
          exit();
        }
        else if ($PasswordCheck == true) {
          session_start();
          $_SESSION['uidUsers'] = $row['uid30set'];
          $_SESSION['Username'] = $row['up30set'];

          header("Location: ../index.php");
          exit();
        }
        else {
          header("Location: ../login.php?error=WrongPassword");
          exit();
        }
      }
      else {
        header("Location: ../login.php?error=nouser");
        exit();
      }
    }
  }
}
else {
  header("Location: ../login.php");
  exit();
}
