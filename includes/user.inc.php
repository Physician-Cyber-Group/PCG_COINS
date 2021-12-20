<?php
session_start();
include 'function.php';
if(isset($_POST['recharge']))
{
  require 'dbh.inc.php';
  $Status = "Pending";
  $UserBank = $_POST['UserBank'];
  $adminBank = $_SESSION['MAMA3060'];
  $Username = $_SESSION['Username'];
  $jaggan = $_SESSION['banngabanga'];
  $jagajaga = $Username. " ".$jaggan;
  $User = $_POST['User'];
  $Amount = $_POST['Amount'];
  $file = $_FILES['file'];

  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  $fileExt = explode('.',$fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg', 'jpeg', 'png', 'pdf');
  if (empty($jagajaga) || empty($UserBank) || empty($adminBank) || empty($Status) || empty($Username) || empty($User) || empty($Amount) || empty($file)) {
      header  ("Location: ../deposit.php?error=E356086");
      exit();
  }
  else {
    if (in_array($fileActualExt, $allowed)) {
      if ($fileError === 0) {
        if ($fileSize < 2200000) {
          $fileNameNew = uniqid('',true).".".$fileActualExt;
          $fileDestination = '../pcgnetwork/depositupload/'.$fileNameNew;
          move_uploaded_file($fileTmpName,$fileDestination);
          $query89 = "INSERT INTO udshiga (shitud,ipapad,namashiga,demo, kudsgi, khotsha,yanud,shigaT8998l,T8999shiga) VALUES ('$UserBank','$adminBank','$Username','$User','$Amount','$fileNameNew', '$Status', '$jagajaga', '$jaggan')";
          $query_run89 = mysqli_query($conn, $query89);
          if($query_run89)
          {
            header  ("Location: ../deposit.php?Upload=S356087");
            exit();
          }
          else{
            header  ("Location: ../deposit.php?error=E356088");
            exit();
          }
        }
        else {
          header  ("Location: ../deposit.php?error=E356089");
          exit();
        }
      }
      else {
        header  ("Location: ../deposit.php?error=E356090");
        exit();
      }
    }else {
      header  ("Location: ../deposit.php?error=E356091");
      exit();
    }
  }
}
elseif (isset($_POST['Banksave'])) {
    require 'dbh.inc.php';

  $Username = $_SESSION['Username'];
  $Status = "Pending Review";
  $Bank_Name = $_POST['CardName'];
  $Account_Name = "Pending Review";
  $Account_Number = $_POST['AcctNum'];

  if (empty($Bank_Name) || empty($Account_Name) || empty($Account_Number) || empty($Username) || empty($Status)) {
    header("Location: ../set.php?error=E2");
    exit();
  }
  else {
    $sql = "SELECT * FROM pure788bupa WHERE zaga70bupa=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header  ("Location: ../set.php");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $Account_Number);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck1 = mysqli_stmt_num_rows($stmt);
      if ($resultCheck1 > 0) {
        header("Location: ../set.php?error=E3");
        exit();
      }
      else {
        $sql = "INSERT INTO pure788bupa (makwa9887bupa,bupa29zamfara,bupa60nana,zaga70bupa,kano303bupa) VALUES (?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../set.php?error=sqlerror");
          exit();
        }
        else {
          mysqli_stmt_bind_param($stmt, "sssss" , $Account_Name, $Username, $Bank_Name, $Account_Number, $Status);
          mysqli_stmt_execute($stmt);
          header("Location: ../set.php?Bank=S6");
          exit();
        }
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
elseif (isset($_POST['Withdraw'])) {
  require 'dbh.inc.php';

  $Username = $_SESSION['Username'];
  $Amount = $_POST['AmountW'];
  $ID = $_SESSION['DAGADAGA'];
  $SHSHA= $_POST['235669B'];
  $TansComp = "PCG";
  $admin26 = "Physician_Uthmern_98";
  $Status = "Pending";
  $PIN = $_POST['PINW'];

  if (empty($SHSHA) || empty($admin26) || empty($Amount) || empty($Username) || empty($PIN) || empty($ID) || empty($Status) ) {
    header("Location: ../Withdraw.php?error=E3560");
    exit();
  }
  else {
    $sql1 = "SELECT * FROM dns079set WHERE up30set=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql1)) {
      header("Location: ../Withdraw.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $Username);
      mysqli_stmt_execute($stmt);
      $result1 = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result1)) {
        $PINCheck = password_verify($PIN, $row['dns9pns']);
        if ($PINCheck == false) {
          header("Location: ../Withdraw.php?error=E3561");
          exit();
        }
        else if ($PINCheck == true) {
          if ($row['nba1010set'] != $row['nba1010set']) {
            header("Location: ../Withdraw.php?error=E3562");
            exit();
          }
          else {
            if($row['nba1010set'] < $Amount)
            {
              header('Location: ../Withdraw.php?error=E3563');
              exit();
            } elseif ($Amount < 1000) {
              header('Location: ../Withdraw.php?error=E3564');
              exit();
            }
            else{
              $sql3 = "SELECT * FROM dns079set WHERE up30set=?;";
              $stmt3 = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt3, $sql3)) {
                header("Location: ../Transferpcg.php?error=sqlerror");
                exit();
              }
              else {
                mysqli_stmt_bind_param($stmt3, "s", $Username);
                mysqli_stmt_execute($stmt3);
                $result3 = mysqli_stmt_get_result($stmt3);
                if ($row3 = mysqli_fetch_assoc($result3)) {
                  $minus = $row3['nba1010set'] - $Amount ;
                  $query1 = "UPDATE dns079set SET nba1010set='$minus' WHERE up30set ='$Username'" ;
                  $query_run1 = mysqli_query($conn, $query1);
                  if($query_run1)
                  {
                    $sql2 = "SELECT * FROM full001pure WHERE pure846up=?;";
                    $stmt2 = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                      header("Location: ../Transferpcg.php?error=sqlerror");
                      exit();
                    }
                    else {
                      mysqli_stmt_bind_param($stmt2, "s", $admin26);
                      mysqli_stmt_execute($stmt2);
                      $result2 = mysqli_stmt_get_result($stmt2);
                      if ($row2 = mysqli_fetch_assoc($result2)) {
                        $add = $row2['nc989pure'] + $Amount ;
                        $query = "UPDATE full001pure SET nc989pure='$add' WHERE pure777ba ='$admin26'" ;
                        $query_run = mysqli_query($conn, $query);
                        if($query_run)
                        {
                          require 'dbh.inc.php';
                          $Transid = $TansComp.random_no(7);
                          $sql60 = "INSERT INTO wrc888fal (amo973fal,id80aguje,wrctid,yny21fal,fal70yae,depowrc) VALUES (?,?,?,?,?,?)";
                          $stmt60 = mysqli_stmt_init($conn);
                          if (!mysqli_stmt_prepare($stmt60, $sql60)) {
                            header("Location: ../withdraw.php?error=sqlerror");
                            exit();
                          }
                          else {
                            mysqli_stmt_bind_param($stmt60, "ssssss", $Amount, $ID, $Transid, $Status, $Username, $SHSHA);
                            mysqli_stmt_execute($stmt60);
                            header('Location: ../withdraw.php?success=S3565');
                            exit();
                          }
                        }
                        else{
                          header('Location: ../Withdraw.php?error=E3562');
                          exit();
                        }
                      }
                    }
                  }
                }
                else{
                  header('Location: ../Withdraw.php?error=E3563');
                  exit();
                }
              }
              
            }
          }
        }
        else {
          header("Location: ../Withdraw.php?error=E3561");
          exit();
        }
      }
      else {
        header("Location: ../Withdraw.php?error=E3562");
        exit();
      }
    }
  }
}
else{
    header("Location: ../index.php");
    exit();
}