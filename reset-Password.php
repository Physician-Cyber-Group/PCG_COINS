<?php
require "header.php"
?>
  <title>PCG NETWORK CITY | Reset Password</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/style.css">
  <link href="css/Another.css" rel="stylesheet">
  <link rel="stylesheet" href="css/Astyle.css">
  <link rel="stylesheet" href="css/Another.css">
  <link rel="stylesheet" href="css/Cstyle.css">
  <body id="background">
    <div class="box">
          <h3>Reset Password</h3>
          <p>An Email will be sent to you with instructions on how to reset your Password.</p>
          <form action="includes/reset-request.inc.php" method="post">
            <input class="yallabai" type="text" placeholder="Enter Your Email" name="Email"><br><br>
            <button class="sumy" name="Reset-request-submit" type="submit">Recieve new Password By Email</button><br><br>
          <?php
          if (isset($_GET["reset"])) {
            if ($_GET["reset"] == "Success") {
              echo '<div class="popup center">
                <div class="icon">
                  <i class="fa fa-check"></i>
                </div>
                <div class="title"><em>Success!!</em></div><br>
                <div class="description">
                An Email Has Been Sent to Your Email Address With an Instruction</div><br>
                <div class="dismiss-btn">
                  <button id="dismiss-popup-btn">Dismiss</button>
                </div>
              </div>';
            }
          }
          elseif (isset($_GET["error"])) {
            if ($_GET['error'] == "Error") {
              echo '<div class="ibabu ibabu--visible ibabu--error">There Was An Error Somewhere</div>';
            }
            else if ($_GET['error'] == "norecord") {
              echo '<div class="ibabu ibabu--visible ibabu--error">Please Resubmit and Click On Our Officially Link Sent Your Email</div>';
            }
            else if ($_GET['error'] == "E033") {
              echo '<div class="ibabu ibabu--visible ibabu--error">Please Resubmit and Click On Our Officially Link Sent Your Email</div>';
            }
            if ($_GET['error'] == "E034") {
              echo '<div class="ibabu ibabu--visible ibabu--error">You are Not Our Active Physician Kindly Register Or Contact Our PCG TEAM</div>';
            }
            else if ($_GET['error'] == "E035") {
              echo '<div class="ibabu ibabu--visible ibabu--error">Please Resubmit and Click On Our Officially Link Sent Your Email</div>';
            }
            else if ($_GET['error'] == "sql1") {
              echo '<div class="ibabu ibabu--visible ibabu--error">Unfortunately We Counld not Update Your New Password Please Contact The PCG TEAM</div>';
            }
            else if ($_GET['error'] == "sql2") {
              echo '<div class="ibabu ibabu--visible ibabu--error">Unfortunately There Was  an Error SomeWhere Please Contact The PCG TEAM</div>';
            }
          }
          ?>
          </form>
    </div>
    <div style="padding:20px; color:#ffffff; background-color: #804d004f; text-align: center;">
      <footer>
        <p>PCG Coins, Copyright &copy; 2021</p>
      </footer>
    </div>
  </body>
</html>
