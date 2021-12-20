<?php
session_start();
include 'function.php';

if (isset($_POST['sell'])) {
  require 'dbh.inc.php';

  $Self = $_SESSION['Username'];
  $sellAmount = $_POST['sellAmount'];
  $nasa = $sellAmount*95/100;
  $mrrpcg = $sellAmount*1/100;
  $namu = $sellAmount*99/100;
  $refer = $_POST['refer'];
  $CV123 = "PCG SELL";
  $userT = "INVITED";
  $user = "UNINVITED";
  $TanComp = "PCG";
  $admin = "Physician_Uthmern_98";
  if (empty($Self) || empty($sellAmount)) {
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
        if($row['dns10pba'] < $sellAmount)
        {
          header('Location: ../balance.php?error=E33900');
          exit();
        }
        elseif ($sellAmount < 20) {
          header('Location: ../balance.php?error=E33901');
          exit();
        }
        elseif ($row['icg5set'] != $refer) {
          header("Location: ../balance.php?error=E33899");
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
              $minus = $row3['dns10pba'] - $sellAmount ;
              $query1 = "UPDATE dns079set SET dns10pba='$minus' WHERE up30set ='$Self'" ;
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
                    $add = $row2['pure777ba'] + $namu;
                    $mrr = $mrrpcg * $row2['pure684pn'];
                    $query = "UPDATE full001pure SET pure777ba='$add' WHERE pure846up ='$admin'" ;
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
                                  $getsme = $nasa * $row2['pure684pn'];
                                  $add2 = $row2['nc989pure'] - $getsme;
                                  $query8 = "UPDATE full001pure SET nc989pure ='$add2' WHERE pure846up ='$admin'" ;
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
                                        $minus9 = $row9['nba1010set'] + $getsme ;
                                        $query9 = "UPDATE dns079set SET nba1010set='$minus9' WHERE up30set ='$Self'" ;
                                        $query_run9 = mysqli_query($conn, $query9);
                                        if ($query_run9) {
                                          require 'dbh.inc.php';
                                          $Tranid = $TanComp.random_no(7);
                                          $AMOUNT653 = $TanComp.$sellAmount;
                                          $sql600 = "INSERT INTO mada999tau (amo7080tau,mada1300phy,zam19tau,elus9160mada,tyu9888tau) VALUES (?,?,?,?,?)";
                                          $stmt600 = mysqli_stmt_init($conn);
                                          if (!mysqli_stmt_prepare($stmt600, $sql600)) {
                                            header("Location: ../balance.php?error=E33899");
                                            exit();
                                          }
                                          else {
                                            mysqli_stmt_bind_param($stmt600, "sssss", $AMOUNT653, $Self, $CV123, $Tranid,$userT);
                                            mysqli_stmt_execute($stmt600);
                                            session_start();
                                            $_SESSION['zuga'] = $getsme;
                                            $_SESSION['fana'] = $Tranid;
                                            $_SESSION['zatan'] = $AMOUNT653;
                                            header('Location: ../balance.php?success=S33902');
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
                            $getsme = $nasa * $row2['pure684pn'];
                            $add2 = $row2['nc989pure'] - $getsme;
                            $query8 = "UPDATE full001pure SET nc989pure ='$add2' WHERE pure846up ='$admin'" ;
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
                                  $minus9 = $row9['nba1010set'] + $getsme ;
                                  $query9 = "UPDATE dns079set SET nba1010set='$minus9' WHERE up30set ='$Self'" ;
                                  $query_run9 = mysqli_query($conn, $query9);
                                  if ($query_run9) {
                                    require 'dbh.inc.php';
                                    $Tranid = $TanComp.random_no(7);
                                    $AMOUNT653 = $TanComp.$sellAmount;
                                    $sql600 = "INSERT INTO mada999tau (amo7080tau,mada1300phy,zam19tau,elus9160mada,tyu9888tau) VALUES (?,?,?,?,?)";
                                    $stmt600 = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($stmt600, $sql600)) {
                                      header("Location: ../balance.php?error=E33899");
                                      exit();
                                    }
                                    else {
                                      mysqli_stmt_bind_param($stmt600, "sssss", $AMOUNT653, $Self, $CV123, $Tranid,$user);
                                      mysqli_stmt_execute($stmt600);
                                      session_start();
                                      $_SESSION['zuga'] = $getsme;
                                      $_SESSION['fana'] = $Tranid;
                                      $_SESSION['zatan'] = $AMOUNT653;
                                      header('Location: ../balance.php?success=S33902');
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
