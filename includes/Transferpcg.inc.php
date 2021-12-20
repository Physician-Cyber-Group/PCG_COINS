<?php
session_start();
include 'function.php';

if (isset($_POST['TP2P'])) {
  require 'dbh.inc.php';

  $Transfer = $_POST['Transfer'];
  $Username = $_POST['TUser'];
  $MyUsername = $_SESSION['Username'];
  $PIN = $_POST['PIN1'];
  $DALIL = "TRANSFER";
  $DAL = "REFUND FOR INVALID USERAME ";
  $Hali = "PCG";
  $MINE = "-PCG";
  $BAB = "+PCG";
  $GABA ="FROM ". $_SESSION['Username']. " TO ";
  
  if (empty($Username) || empty($PIN) || empty($Transfer)) {
    header("Location: ../Transferpcg.php?error=E556089");
    exit();
  }
  else {
    $sql1 = "SELECT * FROM dns079set WHERE up30set=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql1)) {
      header("Location: ../Transferpg.php?error=E556090");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $MyUsername);
      mysqli_stmt_execute($stmt);
      $result1 = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result1)) {
        $AtoCheck = password_verify($PIN, $row['dns9pns']);
        if ($AtoCheck == false) {
          header("Location: ../Transferpcg.php?error=E5534");
          exit();
        }
        else if ($AtoCheck == true) {
          if($row['dns10pba'] < $Transfer)
          {
            header('Location: ../Transferpcg.php?error=E5530');
            exit();
          }elseif ($Transfer < 0) {
            header('Location: ../Transferpcg.php?error=E5531');
            exit();
          }
          elseif ($Username == $MyUsername) {
            header('Location: ../Transferpcg.php?error=E5532');
            exit();
          }
          else{
            $sql3 = "SELECT * FROM dns079set WHERE up30set=?;";
            $stmt3 = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt3, $sql3)) {
              header("Location: ../Transferpcg.php?error=E556090");
              exit();
            }
            else {
              mysqli_stmt_bind_param($stmt3, "s", $MyUsername);
              mysqli_stmt_execute($stmt3);
              $result3 = mysqli_stmt_get_result($stmt3);
              if ($row3 = mysqli_fetch_assoc($result3)) {
                $minus = $row3['dns10pba'] - $Transfer ;
                $query1 = "UPDATE dns079set SET dns10pba='$minus' WHERE up30set ='$MyUsername'" ;
                $query_run1 = mysqli_query($conn, $query1);
                if($query_run1)
                {
                  require 'dbh.inc.php';
                  $Tranid = $Hali.random_no(7);
                  $AMOUNT653 = $MINE.$Transfer;
                  $JAKI = $GABA. $Username;
                  $sql600 = "INSERT INTO mada999tau (amo7080tau,mada1300phy,zam19tau,elus9160mada,ban88nema) VALUES (?,?,?,?,?)";
                  $stmt600 = mysqli_stmt_init($conn);
                  if (!mysqli_stmt_prepare($stmt600, $sql600)) {
                    header("Location: ../Transferpcg.php?error=E556090");
                    exit();
                  }
                  else {
                    mysqli_stmt_bind_param($stmt600, "sssss", $AMOUNT653, $MyUsername, $DALIL, $Tranid,$JAKI);
                    mysqli_stmt_execute($stmt600);
                    $sql2 = "SELECT * FROM dns079set WHERE up30set=?;";
                    $stmt2 = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                      header("Location: ../Transferpcg.php?error=E556090");
                      exit();
                    }
                    else {
                      mysqli_stmt_bind_param($stmt2, "s", $Username);
                      mysqli_stmt_execute($stmt2);
                      $result2 = mysqli_stmt_get_result($stmt2);
                      if ($row2 = mysqli_fetch_assoc($result2)) {
                        $add = $row2['dns10pba'] + $Transfer ;
                        $query = "UPDATE dns079set SET dns10pba='$add' WHERE up30set ='$Username'" ;
                        $query_run = mysqli_query($conn, $query);
                        if($query_run)
                        {
                          require 'dbh.inc.php';
                          $Tranid = $Hali.random_no(7);
                          $AMOUNT653 = $BAB.$Transfer;
                          $JAKI = $GABA. $Username;
                          $sql600 = "INSERT INTO mada999tau (amo7080tau,mada1300phy,zam19tau,elus9160mada,ban88nema) VALUES (?,?,?,?,?)";
                          $stmt600 = mysqli_stmt_init($conn);
                          if (!mysqli_stmt_prepare($stmt600, $sql600)) {
                            header("Location: ../Transferpcg.php?error=E556090");
                            exit();
                          }
                          else {
                            mysqli_stmt_bind_param($stmt600, "sssss", $AMOUNT653, $Username, $DALIL, $Tranid,$JAKI);
                            mysqli_stmt_execute($stmt600);
                            $AMOUNT65553 = $Transfer.$Hali;
                            session_start();
                            $_SESSION['zugaga'] = $Username;
                            $_SESSION['zalatan'] = $AMOUNT65553;
                            $_SESSION['fatana'] = $Tranid;
                            header('Location: ../Transferpcg.php?success=S32225');
                            exit();
                          }
                        }
                        else{
                          $sql3 = "SELECT * FROM dns079set WHERE up30set=?;";
                          $stmt3 = mysqli_stmt_init($conn);
                          if (!mysqli_stmt_prepare($stmt3, $sql3)) {
                            header("Location: ../Transferpcg.php?error=E556090");
                            exit();
                          }
                          else {
                            mysqli_stmt_bind_param($stmt3, "s", $MyUsername);
                            mysqli_stmt_execute($stmt3);
                            $result3 = mysqli_stmt_get_result($stmt3);
                            if ($row3 = mysqli_fetch_assoc($result3)) {
                              $minus = $row3['dns10pba'] + $Transfer ;
                              $query1 = "UPDATE dns079set SET dns10pba='$minus' WHERE up30set ='$MyUsername'" ;
                              $query_run1 = mysqli_query($conn, $query1);
                              if($query_run1)
                              {
                                require 'dbh.inc.php';
                                $Tranid = $Hali.random_no(7);
                                $AMOUNT653 = $BAB.$Transfer;
                                $JAKI = $DAL. $Username;
                                $sql600 = "INSERT INTO mada999tau (amo7080tau,mada1300phy,zam19tau,elus9160mada,ban88nema) VALUES (?,?,?,?,?)";
                                $stmt600 = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($stmt600, $sql600)) {
                                  header("Location: ../Transferpcg.php?error=E556090");
                                  exit();
                                }
                                else {
                                  mysqli_stmt_bind_param($stmt600, "sssss", $AMOUNT653, $MyUsername, $DALIL, $Tranid,$JAKI);
                                  mysqli_stmt_execute($stmt600);
                                  header("Location: ../Transferpcg.php?error=E5533");
                                  exit();
                                }
                              }
                              else {
                                header('Location: ../Transferpcg.php?error=E5533');
                                exit();
                              }
                            }
                            else {
                              header('Location: ../Transferpcg.php?error=E5533');
                              exit();
                            }
                          }
                        }
                      }
                      else{
                        $sql3 = "SELECT * FROM dns079set WHERE up30set=?;";
                        $stmt3 = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt3, $sql3)) {
                          header("Location: ../Transferpcg.php?error=E556090");
                          exit();
                        }
                        else {
                          mysqli_stmt_bind_param($stmt3, "s", $MyUsername);
                          mysqli_stmt_execute($stmt3);
                          $result3 = mysqli_stmt_get_result($stmt3);
                          if ($row3 = mysqli_fetch_assoc($result3)) {
                            $minus = $row3['dns10pba'] + $Transfer ;
                            $query1 = "UPDATE dns079set SET dns10pba='$minus' WHERE up30set ='$MyUsername'" ;
                            $query_run1 = mysqli_query($conn, $query1);
                            if($query_run1)
                            {
                              require 'dbh.inc.php';
                              $Tranid = $Hali.random_no(7);
                              $AMOUNT653 = $BAB.$Transfer;
                              $JAKI = $DAL;
                              $sql600 = "INSERT INTO mada999tau (amo7080tau,mada1300phy,zam19tau,elus9160mada,ban88nema) VALUES (?,?,?,?,?)";
                              $stmt600 = mysqli_stmt_init($conn);
                              if (!mysqli_stmt_prepare($stmt600, $sql600)) {
                                header("Location: ../Transferpcg.php?error=E556090");
                                exit();
                              }
                              else {
                                mysqli_stmt_bind_param($stmt600, "sssss", $AMOUNT653, $MyUsername, $DALIL, $Tranid,$JAKI);
                                mysqli_stmt_execute($stmt600);
                              }
                            }
                            else {
                              header('Location: ../Transferpcg.php?error=E5533');
                              exit();
                            }
                          }
                          else {
                            header('Location: ../Transferpcg.php?error=E5533');
                            exit();
                          }
                        }
                        header('Location: ../Transferpcg.php?error=E5533');
                        exit();
                      }
                    }
                  }
                }
                else{
                  session_destroy();
                  unset($_SESSION['Username']);
                  header("Location: ../login.php");
                }
              }
              else{
                header('Location: ../Transferpcg.php?error=E5530');
                exit();
              }
            }
            
          }
        }
        else {
          header("Location: ../Transferpcg.php?error=E5534");
          exit();
        }
      }
      else {
        header("index.php?logout='1'");
        exit();
      }
    }
  }
}
else {
  header("Location: ../login.php");
  exit();
}
