<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="desription" content="Affordable Coins For Buying and Selling">
    <meta name="keyword" content="This is a City where PCG is been Trending and You Can Also Work For it">
    <meta name="author" content="Uthmern Physician">
    <title>PCG CITY | Sign  In</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/anoy.css" rel="stylesheet" type="text/css">
    <link href="css/Another.css" rel="stylesheet" type="text/css">
    <link href="css/ano.css" rel="stylesheet" type="text/css">
  </head>
  <body class="jigirya">
    <div class="wrapper">
      <?php
      if (isset($_GET['error'])) {
        if ($_GET['error'] == "EmptyFields") {
          echo '<div class="ibabu ibabu--visible ibabu--error">Fill in All empty Field</div>';
        }
        else if ($_GET['error'] == "WrongPassword") {
          echo '<div class="ibabu ibabu--visible ibabu--error">Wrong Password Log In Please Try The Forgot Password Function Bellow</div>';
        }
        else if ($_GET['error'] == "nouser") {
          echo '<div class="ibabu ibabu--visible ibabu--error">There is No Physician With Such Log In Please try Don,t have an Account Function Bellow</div>';
        }
      }
      ?>
      <section class="form">
        <form action="includes/login.inc.php"class="Signup" method="post">
          <div>
      
            <a class="karara" style="padding:10px; text-decoration: none;" href="index.html">Go to Home</a>
          </div>
          <h3>SIGN IN</h3>
          <div class="shekara input">
            <label>Username</label>
            <input type="text" placeholder="Enter Your Username" name="Username">
          </div>
          <div class="shekara input">
            <LABEL>Password</LABEL>
            <input type="Password" name="Password" placeholder="Enter Your Password">
            <i class="fas fa-eye"></i>
          </div>
          <div class="shekara button">
            <button name="login-submit" type="submit">Login</button>
            <a style="color:#be17a2; text-decoration: none;" href="reset-Password.php">Forgot Your Password</a>
            <div class="jalo" >Don't Have An Account?<a style="color:#00C02B; text-decoration: none;" href="form.php"> Sign Up</a></div>
          </div>
        <?php
        if (isset($_GET['newpwd'])) {
          if ($_GET['newpwd'] == "Passwordupdated") {
            echo '<div class="popup center">
              <div class="icon">
                <i class="fa fa-check"></i>
              </div>
              <div class="title"><em>Success!!</em></div><br>
              <div class="description">
              New Physician Password is Successifully Updated</div><br>
              <div class="dismiss-btn">
                <button id="dismiss-popup-btn" >Dismiss</button>
              </div>
            </div>';
          }
        }
        ?>
        </form>
      </section>
    </div>
    <script src="js/jaga.js"></script>
  </body>
</html>
