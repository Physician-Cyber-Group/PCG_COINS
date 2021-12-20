<?php
include 'function.php';
if (isset($_POST['signup-submit'])) {

  require 'dbh.inc.php';

  $R1001 = $_POST['First_Name'];
  $R1002 = $_POST['Surname'];
  $R1003 = $_POST['Other_Names'];
  $R10040 = $_POST['Username'];
  $R10050 = $_POST['Email'];
  $R10060 = $_POST['Phone_Number'];
  $R10071 = $_POST['invite_code'];
  $R10082 = $_POST['Gender'];
  $R10093 = $_POST['Birthdate'];
  $R10100 = $_POST['Password'];
  $R10111 = $_POST['Password_1'];
  $R10122 = $_POST['PIN'];
  $R10144 = $_POST['dil302'];
  $R10188 = $_POST['PIN_1'];

  if ( empty($R1001) || empty($R1002) || empty($R10040) || empty($R10050) || empty($R10060) || empty($R10082) || empty($R10093) || empty($R10100) || empty($R10111) || empty($R10122)) {
    header("Location: ../form.php?error=EmptyFields&First_Name=" .$R1001."&Surname=" .$R1002."&Other_Names=" .$R1003."&Username=" .$R10040."&Email=" .$R10050."&Phone_Number=" .$R10060."&Gender=" .$R10082."&Birthdate=" .$R10093);
    exit();
  }
  else if (!filter_var($R10050, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $R10040)) {
    header("Location: ../form.php?error=InvalidEmailUsername&First_Name=" .$R1001."&Surname=" .$R1002."&Other_Names=" .$R1003."&Phone_Number=" .$R10060."&Gender=" .$R10082."&Birthdate=" .$R10093);
    exit();
  }
  else if (!filter_var($R10050, FILTER_VALIDATE_EMAIL)) {
  header("Location: ../form.php?error=InvalidEmail&First_Name=" .$R1001."&Surname=" .$R1002."&Other_Names=" .$R1003."&Username=" .$R10040."&Phone_Number=" .$R10060."&Gender=" .$R10082."&Birthdate=" .$R10093);
  exit();
  }
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $R10040)) {
    header("Location: ../form.php?error=InvalidUsername&First_Name=" .$R1001."&Surname=" .$R1002."&Other_Names=" .$R1003."&Email=" .$R10050."&Phone_Number=" .$R10060."&Gender=" .$R10082."&Birthdate=" .$R10093);
    exit();
  }
  else if ($R10100 !== $R10111) {
    header("Location: ../form.php?error=PasswordDontmatch&First_Name=" .$R1001."&Surname=" .$R1002."&Other_Names=" .$R1003."&Username=" .$R10040."&Email=" .$R10050."&Phone_Number=" .$R10060."&Gender=" .$R10082."&Birthdate=" .$R10093);
    exit();
  }
  else if ($R10122 !== $R10188) {
    header("Location: ../form.php?error=PINDontmatch&First_Name=" .$R1001."&Surname=" .$R1002."&Other_Names=" .$R1003."&Username=" .$R10040."&Email=" .$R10050."&Phone_Number=" .$R10060."&Gender=" .$R10082."&Birthdate=" .$R10093);
    exit();
  }
  else {

    $sql = "SELECT up30set FROM dns079set WHERE pnb36kr=? AND up30set=? AND maga90e=?";
    $sql1 = "SELECT up30set FROM dns079set WHERE pnb36kr=? AND up30set=?";
    $sql2 = "SELECT up30set FROM dns079set WHERE up30set=? AND maga90e=?";
    $sql3 = "SELECT up30set FROM dns079set WHERE pnb36kr=?";
    $sql4 = "SELECT up30set FROM dns079set WHERE up30set=?";
    $sql6 = "SELECT up30set FROM dns079set WHERE icg5set=?";
    $sql5 = "SELECT up30set FROM dns079set WHERE maga90e=?";
    $stmt = mysqli_stmt_init($conn);
    $uidUsers = random_num(6);
    $sql8965233 = "SELECT up30set FROM dns079set WHERE uid30set=?";

    if (!empty($uidUsers)) {
      if (!mysqli_stmt_prepare($stmt, $sql8965233)) {
        header  ("Location: ../form.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "s", $uidUsers);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $result562 = mysqli_stmt_num_rows($stmt);
        if ($result562 > 0) {
          header("Location: ../form.php?error=sqlerror2");
          exit();
        }
      }
    }else
    if (!empty($R10071)) {
      if (!mysqli_stmt_prepare($stmt, $sql6)) {
        header  ("Location: ../form.php?error=sqlerror3");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "s", $R10071);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck1 = mysqli_stmt_num_rows($stmt);
        if ($resultCheck1 == 0) {
          header("Location: ../form.php?error=InvalidInvitationCode&First_Name=" .$R1001."&Surname=" .$R1002."&Other_Names=" .$R1003."&Gender=" .$R10082."&Birthdate=" .$R10093);
          exit();
        }
      }
    }else
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header  ("Location: ../form.php?error=sqlerror4");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "sss", $R10060, $R10040, $R10050);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck1 = mysqli_stmt_num_rows($stmt);
      if ($resultCheck1 > 0) {
        header("Location: ../form.php?error=PhoneNumberUsernameEmailAlreadyTaken&First_Name=" .$R1001."&Surname=" .$R1002."&Other_Names=" .$R1003."&Gender=" .$R10082."&Birthdate=" .$R10093);
        exit();
      }
    }
    if (!mysqli_stmt_prepare($stmt, $sql1)) {
      header  ("Location: ../form.php?error=sqlerror5");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "ss", $R10060, $R10040);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck2 = mysqli_stmt_num_rows($stmt);
      if ($resultCheck2 > 0) {
        header("Location: ../form.php?error=PhoneNumberUsernameAlreadyTaken&First_Name=" .$R1001."&Surname=" .$R1002."&Other_Names=" .$R1003."&Email=" .$R10050."&Gender=" .$R10082."&Birthdate=" .$R10093);
        exit();
      }
    }
    if (!mysqli_stmt_prepare($stmt, $sql2)) {
      header  ("Location: ../form.php?error=sqlerror6");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "ss", $R10040, $R10050);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck3 = mysqli_stmt_num_rows($stmt);
      if ($resultCheck3 > 0) {
        header("Location: ../form.php?error=UsernameEmailAlreadyTaken&First_Name=" .$R1001."&Surname=" .$R1002."&Other_Names=" .$R1003."&Phone_Number=" .$R10060."&Gender=" .$R10082."&Birthdate=" .$R10093);
        exit();
      }
    }
    if (!mysqli_stmt_prepare($stmt, $sql4)) {
      header  ("Location: ../form.php?error=sqlerror7");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $R10040);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck4 = mysqli_stmt_num_rows($stmt);
      if ($resultCheck4 > 0) {
        header("Location: ../form.php?error=UsernameAlreadyTaken&First_Name=" .$R1001."&Surname=" .$Surname."&Other_Names=" .$Other_Names."&Email" . $R10050."&Phone_Number=" .$R10060."&Gender=" .$R10082."&Birthdate=" .$R10093);
        exit();
      }
    }
    if (!mysqli_stmt_prepare($stmt, $sql5)) {
      header  ("Location: ../form.php?error=sqlerror8");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $R10050);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck5 = mysqli_stmt_num_rows($stmt);
      if ($resultCheck5 > 0) {
        header("Location: ../form.php?error=EmailAlreadyTaken&First_Name=" .$R1001."&Surname=" .$R1002."&Other_Names=" .$R1003."&Username" .$R10040."&Phone_Number=" .$R10060."&Gender=" .$R10082."&Birthdate=" .$R10093);
        exit();
      }
    }
    if (!mysqli_stmt_prepare($stmt, $sql3)) {
      header  ("Location: ../form.php?error=sqlerror9");
      exit();
    }
    else {
      if (empty($R10144)) {
        header  ("Location: ../form.php?error=YMAWOTC");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "s", $R10060);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck6 = mysqli_stmt_num_rows($stmt);
        if ($resultCheck6 > 0) {
          header("Location: ../form.php?error=PhoneNumberAlreadyTaken&First_Name=" .$R1001."&Surname=" .$R1002."&Other_Names=" .$R1003."&Phone_Number=" .$R10060."&Gender=" .$R10082."&Birthdate=" .$R10093);
          exit();
        }
        else {
          require 'dbh.inc.php';
          $sql60 = "INSERT INTO dns079set (uid30set, set598fs, sm897dns, set333os, up30set, maga90e, pnb36kr, gmn459dns, dns7879bh, pks2354dns,dns9pns,icg5set,tcs3040set) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
          $stmt60 = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt60, $sql60)) {
            header("Location: ../form.php?error=sqlerror665");
            exit();
          }
          else {
            $hashedPassword = Password_hash($R10100, PASSWORD_DEFAULT);
            $hashedPin = Password_hash($R10122, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt60, "sssssssssssss", $uidUsers, $R1001, $R1002, $R1003, $R10040, $R10050, $R10060, $R10082, $R10093, $hashedPassword,$hashedPin,$R10071,$R10144);
            mysqli_stmt_execute($stmt60);
            header("Location: ../form.php?Signup=Success");
            exit();
          }
        }
      }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
}
else {
  header("Location: ../form.php");
  exit();
}
