<?php
if(isset($_SESSION['Username'])){
  require 'dbh.inc.php';
  $QL = $_SESSION['Username'];
  $query = "SELECT * FROM dns079set WHERE up30set='$QL' ";
  $query_run = mysqli_query($conn, $query);
  if(mysqli_num_rows($query_run) < 1) {
      session_destroy();
      unset($_SESSION['Username']);
      header("Location: login.php?error=pleaselogin");
  }
} 
else {
  $_SESSION['msg'] = "You must log in first to view this Page";
  header("Location: ../login.php");
}
function random_num($length)
{
  $text = "";
  if($length < 4)
  {
    $length = 4;
  }
  $len = rand(3, $length);
  for ($i=0; $i < $len; $i++){
    $text .= rand(0,9);
  }
  return $text;
}
function random_numb($length)
{
  $text = "";
  if($length < 9)
  {
    $length = 9;
  }
  $len = rand(9, $length);
  for ($i=0; $i < $len; $i++){
    $text .= rand(0,9);
  }
  return $text;
}


function random_no($length)
{
  $text = "";
  if($length < 6)
  {
    $length = 6;
  }
  $len = rand(6, $length);
  for ($i=0; $i < $len; $i++){
    $text .= rand(0,9);
  }
  return $text;
}

function check_login($conn)
{
  if (isset($_SESSION['uidUsers'])) {
    $id = $_SESSION['uidUsers'];
    $query = "SELECT * FROM users WHERE uidUsers = '$id' limit 1";

    $result = mysqli_query($conn,$query);
    if ($result && mysqli_num_rows($result) > 0)
    {
      $User_data = mysqli_fetch_assoc($result);
      return $User_data;
    }
  }
  header("location: login.php");
  die;
}
