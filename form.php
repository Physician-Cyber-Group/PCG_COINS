<?php
include('includes/header.php');
?>
</div>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="desription" content="Affordable and professional web design">
    <meta name="keyword" content="web design, Affordable web design,professional web design">
    <meta name="author" content="Uthmern Physician">
    <title>PCG CITY | Sign  Up</title>
    <link href="css/Another.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body class="dp">

    <div class="container">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-5 jalallu"></div>
            <div class="col-lg-7">
              <div class="p-5 form">
                <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                </div>
                <form class="user" action="includes/form.inc.php" method="POST">
                    <?php
                    if (isset($_GET['error'])) {
                      if ($_GET['error'] == "EmptyFields") {
                        echo '<div class="ibabu ibabu--visible ibabu--error">Fill in All empty Field</div>';
                      }
                      else if ($_GET['error'] == "InvalidEmailUsername") {
                        echo '<div class="ibabu ibabu--visible ibabu--error">Invalid Email And Username! You Can not Use This Kind Of Info!</div>';
                      }
                      else if ($_GET['error'] == "InvalidEmail") {
                        echo '<p class="ibabu ibabu--visible ibabu--error">Invalid Email! You Can not Use This Kind Of Email</p>';
                      }
                      else if ($_GET['error'] == "InvalidUsername") {
                        echo '<p class="ibabu ibabu--visible ibabu--error">Invalid Username! You Can not Use This Kind Of Username</p>';
                      }
                      else if ($_GET['error'] == "PhoneNumberAlreadyTaken") {
                        echo '<p class="ibabu ibabu--visible ibabu--error">Phone Number is Already Taken By Another Physician! Please Resubmit Another Phone Number</p>';
                      }
                      else if ($_GET['error'] == "InvalidInvitationCode") {
                        echo '<p class="ibabu ibabu--visible ibabu--error">Invalid Invitation Code There is no Physician with this code, Please leave the Invitation Code Blank If You do not have one</p>';
                      }
                      else if ($_GET['error'] == "PhoneNumberUsernameEmailAlreadyTaken") {
                        echo '<p class="ibabu ibabu--visible ibabu--error">Phone Number, Username and Email Already Taken By Another Physician! Please LogIn</p>';
                      }
                      else if ($_GET['error'] == "UsernameEmailAlreadyTaken") {
                        echo '<p class="ibabu ibabu--visible ibabu--error">Username and Email Already Taken By Another Physician! Please Resubmit Another Entries Or Login</p>';
                      }
                      else if ($_GET['error'] == "UsernameAlreadyTaken") {
                        echo '<p class="ibabu ibabu--visible ibabu--error">Username Already Taken By Another Physician! Please Resubmit Another Username Or Login</p>';
                      }
                      else if ($_GET['error'] == "EmailAlreadyTaken") {
                        echo '<p class="babu ibabu--visible ibabu--error">Email Already Taken By Aother Physician! Please Resubmit Another Email</p>';
                      }
                      else if ($_GET['error'] == "PhoneNumberUsernameAlreadyTaken") {
                        echo '<p class="ibabu ibabu--visible ibabu--error">Phone Number Username Already Taken By Another Physician! Please Log In</p>';
                      }
                      else if ($_GET['error'] == "PasswordDontmatch") {
                        echo '<p class="ibabu ibabu--visible ibabu--error">Un Match Passwords! Enter Thesame Password to the Confirm Password Box bellow</p>';
                      }
                      else if ($_GET['error'] == "YMAWOTC") {
                        echo '<p class="ibabu ibabu--visible ibabu--error">You Must Agree With Our Terms And Condition, By Clicking On the T & C BOX</p>';
                      }
                      else if ($_GET['error'] == "PINDontmatch") {
                        echo '<p class="ibabu ibabu--visible ibabu--error">Un Match PIN! Enter Thesame PIN to the Confirm PIN Box bellow</p>';
                      }
                    }
                    else if (isset($_GET['Signup'])) {
                      if ($_GET['Signup'] == "Success" ) {
                        echo '<div class="popup center">
                          <div class="icon">
                            <i class="fa fa-check"></i>
                          </div>
                          <div class="title"><em>Success!!</em></div><br>
                          <div class="description">
                          New Physician Registration is Successiful You Can now login</div><br>
                          <div class="descriminant">
                           If You Caught in anyway trying to have or having multiple Account We will Use Section C Against the Physician of Our <a href="login.php">T & C</a> 
                          </div><br>
                          <div class="dismiss-btn">
                            <button id="dismiss-popup-btn">Dismiss</button>
                          </div>
                        </div>';
                      }
                    }

                    ?>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input  type="text" placeholder="First Name" class="form-control form-control-user" name="First_Name">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" placeholder="Surname" class="form-control form-control-user" name="Surname">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="text" placeholder="Other Names" class="form-control form-control-user" name="Other_Names">
                    </div>
                    <div class="col-sm-6">
                      <input  type="" placeholder="Username" class="form-control form-control-user" name="Username">
                  </div>
                  </div>
                  <div class="form-group">
                    <input type="email"  class="form-control form-control-user" placeholder="Email Address" name="Email">
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input class="form-control form-control-user" type="tel" placeholder="Phone Number" name="Phone_Number">
                    </div>
                    <div class="col-sm-6">
                      <select class="yallabai" name="Gender">
                        <div class="form-control form-control-user">
                          <OPTION >Select Your Gender</OPTION>
                          <OPTION Value="Male">Male</OPTION>
                          <OPTION Value="Female">Female</OPTION>
                          <OPTION Value="Others">Others</OPTION>
                        </div>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="date" class="form-control form-control-user" placeholder="MM/DD/YYYY" name="Birthdate">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="invite_code" class="form-control form-control-user" value="" placeholder="Please enter the invitation code">
                    </div>
                  </div>
                  <div class="shekara form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input class="form-control form-control-user" type="Password" name="Password" placeholder="Enter Your Password">
                      <i class="fas fa-eye"></i>
                    </div>
                    <div class="col-sm-6">
                      <input class="form-control form-control-user" type="Password" name="Password_1" placeholder="Comfirm Your Password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input class="form-control form-control-user" type="Password" name="PIN" placeholder="Enter Your PIN">
                    </div>
                    <div class="col-sm-6">
                      <input class="form-control form-control-user" type="Password" name="PIN_1" placeholder="Comfirm Your PIN">
                    </div>
                  </div>
                  <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <div class="text-center">
                          <input type="checkbox" class="custom-control-input" name="dil302" id="customCheck">
                          <label class="custom-control-label" for="customCheck">Agreed With <a href="#"> Terms And Conditions</a></label>
                        </div>
                      </div>
                  </div>
                  <button class="magagg" name="signup-submit" type="submit"><strong>Sign Up</strong> </button><br>
                  <div class="text-center">
                    <a href="login.php">Already Have An Account Login</a>
                  </div>
                    <hr>
                  <a href="index.html" class="btn btn-google btn-user btn-block"><i class="fab fa-google fa-fw"></i> <strong>Register with Google</strong> (Coming Soon)</a>
                  <a href="index.html" class="btn btn-facebook btn-user btn-block"><i class="fab fa-facebook-f fa-fw"></i><strong> Register with Facebook</strong> (Coming Soon)</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
          
    <div style="padding:20px; color:#ffffff; background-color:#07ff0756; border: #008000 solid 5px; border-radius: 10px; text-align: center;">
      <footer>
        <p>PCG Coins, Copyright &copy; 2021</p>
      </footer>
    </div>
    <script src="js/jaga.js"></script>
  </body>
</html>
