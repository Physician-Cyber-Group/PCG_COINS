<?php
session_start();
include 'function.php';

if (isset($_POST['buy'])) {
  require 'dbh.inc.php';

  $Self = $_SESSION['Username'];
  $buyAmount = $_POST['buyAmount'];
  $nasa = $buyAmount*95/100;
  $mrr = $buyAmount*2/100;
  $namu = $buyAmount*98/100;
  $refer = $_POST['refer'];
  $TanComp = "PCG";
  $CV123 = "PCG BUY";
  $userT = "INVITED";
  $user = "UNINVITED";
  $VC123 = "NGN";
  $admin = "Physician_Uthmern_98";
  if (empty($Self) || empty($buyAmount)) {
    header("Location: ../balance.php?error=E33895");
    exit();
  }
  else {
    $sql1 = "SELECT * FROM dns079set WHERE up30set=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql1)) {
      header("Location: ../balance.php?error=E33899");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $Self);
      mysqli_stmt_execute($stmt);
      $result1 = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result1)) {
        if($row['nba1010set'] < $buyAmount)
        {
          header('Location: ../balance.php?error=E33896');
          exit();
        }
        elseif ($buyAmount < 500) {
          header('Location: ../balance.php?error=E33897');
          exit();
        }
        else{
          $sql3 = "SELECT * FROM dns079set WHERE up30set=?;";
          $stmt3 = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt3, $sql3)) {
            header("Location: ../balance.php?error=E33899");
            exit();
          }
          else {
            mysqli_stmt_bind_param($stmt3, "s", $Self);
            mysqli_stmt_execute($stmt3);
            $result3 = mysqli_stmt_get_result($stmt3);
            if ($row3 = mysqli_fetch_assoc($result3)) {
              $minus = $row3['nba1010set'] - $buyAmount ;
              $query1 = "UPDATE dns079set SET nba1010set='$minus' WHERE up30set ='$Self'" ;
              $query_run1 = mysqli_query($conn, $query1);
              if($query_run1)
              {
                $sql2 = "SELECT * FROM full001pure WHERE pure846up=?;";
                $stmt2 = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                  header("Location: ../balance.php?error=E33899");
                  exit();
                }
                else {
                  mysqli_stmt_bind_param($stmt2, "s", $admin);
                  mysqli_stmt_execute($stmt2);
                  $result2 = mysqli_stmt_get_result($stmt2);
                  if ($row2 = mysqli_fetch_assoc($result2)) {
                    $add = $row2['nc989pure'] + $namu;
                    $query = "UPDATE full001pure SET nc989pure='$add' WHERE pure846up ='$admin'" ;
                    $query_run = mysqli_query($conn, $query);
                    if($query_run)
                    {
                      if (!empty($refer)) {
                        $sql4 = "SELECT * FROM dns079set WHERE uid30set=?;";
                        $stmt4 = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt4, $sql4)) {
                          header("Location: ../balance.php?error=E33899");
                          exit();
                        }
                        else {
                          mysqli_stmt_bind_param($stmt4, "s", $refer);
                          mysqli_stmt_execute($stmt4);
                          $result4 = mysqli_stmt_get_result($stmt4);
                          if ($row4 = mysqli_fetch_assoc($result4)) {
                            $minus1 = $row4['nba1010set'] + $mrr ;
                            $query4 = "UPDATE dns079set SET nba1010set='$minus1' WHERE uid30set ='$refer'" ;
                            $query_run2 = mysqli_query($conn, $query4);
                            if($query_run2)
                            {
                              $sql2 = "SELECT * FROM full001pure WHERE pure846up=?;";
                              $stmt2 = mysqli_stmt_init($conn);
                              if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                                header("Location: ../balance.php?error=E33899");
                                exit();
                              }
                              else {
                                mysqli_stmt_bind_param($stmt2, "s", $admin);
                                mysqli_stmt_execute($stmt2);
                                $result2 = mysqli_stmt_get_result($stmt2);
                                if ($row2 = mysqli_fetch_assoc($result2)) {
                                  $getsme = $nasa / $row2['pure684pn'];
                                  $add2 = $row2['pure777ba'] - $getsme;
                                  $query8 = "UPDATE full001pure SET pure777ba ='$add2' WHERE pure846up ='$admin'" ;
                                  $query_run8 = mysqli_query($conn, $query8);
                                  if ($query_run8) {
                                    $sql9 = "SELECT * FROM dns079set WHERE up30set=?;";
                                    $stmt9 = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($stmt9, $sql9)) {
                                      header("Location: ../balance.php?error=E33899");
                                      exit();
                                    }
                                    else {
                                      mysqli_stmt_bind_param($stmt9, "s", $Self);
                                      mysqli_stmt_execute($stmt9);
                                      $result9 = mysqli_stmt_get_result($stmt9);
                                      if ($row9 = mysqli_fetch_assoc($result9)) {
                                        $minus9 = $row9['dns10pba'] + $getsme ;
                                        $query9 = "UPDATE dns079set SET dns10pba='$minus9' WHERE up30set ='$Self'" ;
                                        $query_run9 = mysqli_query($conn, $query9);
                                        if ($query_run9) {
                                          require 'dbh.inc.php';
                                          $Tranid = $TanComp.random_no(7);
                                          $AMOUNT563 = $VC123.$buyAmount;
                                          $sql600 = "INSERT INTO mada999tau (amo7080tau,mada1300phy,zam19tau,elus9160mada,tyu9888tau) VALUES (?,?,?,?,?)";
                                          $stmt600 = mysqli_stmt_init($conn);
                                          if (!mysqli_stmt_prepare($stmt600, $sql600)) {
                                            header("Location: ../balance.php?error=E33899");
                                            exit();
                                          }
                                          else {
                                            mysqli_stmt_bind_param($stmt600, "sssss", $AMOUNT563, $Self, $CV123, $Tranid,$userT);
                                            mysqli_stmt_execute($stmt600);
                                            session_start();
                                            $_SESSION['zugga'] = $getsme;
                                            $_SESSION['fatna'] = $Tranid;
                                            $_SESSION['zaltan'] = $AMOUNT563;
                                            header('Location: ../balance.php?success=S33898');
                                            exit();
                                          }
                                        }
                                        
                                      }
                                      else {
                                        header('Location: ../balance.php?error=E33899');
                                        exit();
                                      }
                                    }
                                  }
                                  else {
                                    header('Location: ../balance.php?error=E33899');
                                    exit();
                                  }
                                }
                                else {
                                  header('Location: ../balance.php?error=E33899');
                                  exit();
                                }
                              }
                            }
                            else {
                              header('Location: ../balance.php?error=E33899');
                              exit();
                            }
                          }
                          else {
                            header('Location: ../balance.php?error=E33899');
                            exit();
                          }
                        }
                      }else {
                        $sql2 = "SELECT * FROM full001pure WHERE pure846up=?;";
                        $stmt2 = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                          header("Location: ../balance.php?error=E33899");
                          exit();
                        }
                        else {
                          mysqli_stmt_bind_param($stmt2, "s", $admin);
                          mysqli_stmt_execute($stmt2);
                          $result2 = mysqli_stmt_get_result($stmt2);
                          if ($row2 = mysqli_fetch_assoc($result2)) {
                            $getsme = $nasa / $row2['pure684pn'];
                            $add2 = $row2['pure777ba'] - $getsme;
                            $query8 = "UPDATE full001pure SET pure777ba ='$add2' WHERE pure846up ='$admin'" ;
                            $query_run8 = mysqli_query($conn, $query8);
                            if ($query_run8) {
                              $sql9 = "SELECT * FROM dns079set WHERE up30set=?;";
                              $stmt9 = mysqli_stmt_init($conn);
                              if (!mysqli_stmt_prepare($stmt9, $sql9)) {
                                header("Location: ../balance.php?error=E33899");
                                exit();
                              }
                              else {
                                mysqli_stmt_bind_param($stmt9, "s", $Self);
                                mysqli_stmt_execute($stmt9);
                                $result9 = mysqli_stmt_get_result($stmt9);
                                if ($row9 = mysqli_fetch_assoc($result9)) {
                                  $minus9 = $row9['dns10pba'] + $getsme ;
                                  $query9 = "UPDATE dns079set SET dns10pba='$minus9' WHERE up30set ='$Self'" ;
                                  $query_run9 = mysqli_query($conn, $query9); 
                                  if ($query_run9) {
                                    require 'dbh.inc.php';
                                    $Tranid = $TanComp.random_no(7);
                                    $AMOUNT563 = $VC123.$buyAmount;
                                    $sql600 = "INSERT INTO mada999tau (amo7080tau,mada1300phy,zam19tau,elus9160mada, tyu9888tau) VALUES (?,?,?,?,?)";
                                    $stmt600 = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($stmt600, $sql600)) {
                                      header("Location: ../balance.php?error=E33899");
                                      exit();
                                    }
                                    else {
                                      mysqli_stmt_bind_param($stmt600, "sssss", $AMOUNT563, $Self, $CV123, $Tranid, $user);
                                      mysqli_stmt_execute($stmt600);
                                      session_start();
                                      $_SESSION['zugga'] = $getsme;
                                      $_SESSION['fatna'] = $Tranid;
                                      $_SESSION['zaltan'] = $AMOUNT563;
                                      header('Location: ../balance.php?success=S33898');
                                      exit();
                                    }
                                  }
                                 
                                }
                                else {
                                  header('Location: ../balance.php?error=E33899');
                                  exit();
                                }
                              }
                            }
                            else {
                              header('Location: ../balance.php?error=E33899');
                              exit();
                            }
                          }
                          else {
                            header('Location: ../balance.php?error=E33899');
                            exit();
                          }
                        }
                      }
                    }
                    else{
                      header('Location: ../balance.php?error=E33899');
                      exit();
                    }
                  }
                  else {
                    header('Location: ../balance.php?error=E33899');
                    exit();
                  }
                }
              }
              else {
                header('Location: ../balance.php?error=E33899');
                exit();
              }
            }
            else{
              header('Location: ../balance.php?error=E33899');
              exit();
            }
          } 
        }
      }
      else {
        header("Location: ../balance.php?error=E33899");
        exit();
      }
    }
  }
}
else {
  header("Location: ../login.php");
  exit();
}
