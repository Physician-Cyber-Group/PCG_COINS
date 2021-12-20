<?php
if (isset($_POST["Reset-Password-submit"])) {

  $Selector = $_POST["selector"];
  $validator = $_POST["validator"];
  $password = $_POST["password"];
  $passwordRepeat = $_POST["password-Repeat"];
  if (empty($password) || empty($passwordRepeat)) {
    header("Location: ../create-new-password.php?error=EmptyFields&selector=" .$Selector."&validator=" .$validator);
    exit();
  } else if ($password != $passwordRepeat) {
    header("Location: ../create-new-password.php?error=PasswordDontmatch&selector=" .$Selector."&validator=" .$validator);
    exit();
  }

  $CurrentDate = date("U");

  require 'dbh.inc.php';

  $sql = "SELECT * FROM pure9pwd WHERE pwd76serest=? AND pwd79bunkure >= ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt,$sql)) {
    header("Location: ../reset-Password.php?error=Error");
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "ss", $Selector,$CurrentDate);
    mysqli_stmt_execute($stmt);

    $Result = mysqli_stmt_get_result($stmt);
    if (!$row = mysqli_fetch_assoc($Result)) {
      header("Location: ../reset-Password.php?error=norecord");
      exit();
    } else {
      $TokenBin = hex2bin($validator);
      $TokenCheck = password_verify($TokenBin, $row["dala90pwd"]);
      if ($TokenCheck === False) {
        header("Location: ../reset-Password.php?error=E033");
        exit();
      } else if ($TokenCheck === True) {

        $TokenEmail = $row['ereset80pwd'];

        $sql = "SELECT * FROM dns079set WHERE maga90e=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
          header("Location: ../reset-Password.php?error=E034");
          exit();
        } else {
          mysqli_stmt_bind_param($stmt, "s", $TokenEmail);
          mysqli_stmt_execute($stmt);
          $Result = mysqli_stmt_get_result($stmt);
          if (!$row = mysqli_fetch_assoc($Result)) {
          header("Location: ../reset-Password.php?error=E035");
            exit();
          } else {
            $sql = "UPDATE dns079set SET pks2354dns=? WHERE maga90e=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt,$sql)) {
              header("Location: ../reset-Password.php?error=sql1");
              exit();
            } else {
              $newpwdHash = password_hash($password, PASSWORD_DEFAULT);
              mysqli_stmt_bind_param($stmt, "ss", $newpwdHash, $TokenEmail);
              mysqli_stmt_execute($stmt);

              $sql = "DELETE FROM pure9pwd WHERE ereset80pwd=?";
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: ../reset-Password.php?error=sql");
                exit();
              } else {
                mysqli_stmt_bind_param($stmt, "s", $TokenEmail);
                mysqli_stmt_execute($stmt);
                header("Location: ../login.php?newpwd=Passwordupdated");
              }
            }
          }
        }
      }
    }
  }
}
else {
  header("Location: ../login.php");
}