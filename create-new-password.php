<?php
require "header.php"
?>
  <title>PCG CITY | Sign  In</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/Astyle.css">
  <link rel="stylesheet" href="css/Cstyle.css">
  <link href="css/Another.css" rel="stylesheet">
  <body id="background">
    <div class="box">
          <?php
          if (isset($_GET['error'])) {
            if ($_GET['error'] == "EmptyFields") {
              echo '<div class="ibabu ibabu--visible ibabu--error">Fill in All empty Field</div>';
            }
            else if ($_GET['error'] == "PasswordDontmatch") {
              echo '<div class="ibabu ibabu--visible ibabu--error">Your Password Do not Match Please Provide Correct Entries</div>';
            }
          }
          $Selector = $_GET["selector"];
          $validator = $_GET["validator"];
          if (empty($Selector) || empty($validator)) {
            
          } else {
            if (ctype_xdigit($Selector) !== False && ctype_xdigit($validator) !== False) {
              ?>
              <h3>**Enter the New Password You Request.</h3>
              <form action="includes/reset-password.inc.php"class="Signup" method="POST">
                <input id="text" type="hidden" name="selector" value="<?php echo $Selector ?>">
                <input id="text" type="hidden" name="validator" value="<?php echo $validator ?>">
                <input class="yallabai" type="password" placeholder="Enter a new Password...." name="password"><br><br>
                <input class="yallabai" type="password" placeholder="Repeat a new Password..." name="password-Repeat"><br><br>
                <button class="sumy" name="Reset-Password-submit" type="submit">Reset Password</button><br><br>
              </form>
        <?php
            }
          }
          ?>

    </div>
      <footer>
        <p>PCG Coins, Copyright &copy; 2021</p>
      </footer>
  </body>
</html>
