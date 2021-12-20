<?php
session_start();

if(isset($_SESSION['Username'])){
    require 'includes/dbh.inc.php';
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
    header("Location: login.php");
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['Username']);
    header("Location: login.php");
}
?>
<?php
include('includes/header.php');
include('includes/navbar.php');
?>
<link rel="stylesheet" href="css/Astyle.css">
<link rel="stylesheet" href="css/Another.css">
<link rel="stylesheet" href="css/ano.css">
<link rel="stylesheet" href="css/D50000.css">

    <div class="container-Fluid">

    <div class="card shadow mb-4">
        <div class="card-header by-3">
            <h6 class="m-0 font-weight-bold text-primary">Transfer</h6>
        </div>
        <div class="card-body">
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "E556089" ) {
              echo '<div class="jakili center">
                <div class="icon">
                  <i class="fa" >&times;</i>
                </div>
                <div class="title"><em>Attention!!</em></div><br>
                <div class="description">
                All Fields Must Not Be Empty Please Fill all necessary Fields Or Contact The PCG TEAM</div><br>
                <div class="dismiss-btn">
                  <a id="dismiss-popup-btn" href="balance.php" >Go Back to My Wallet</a>
                </div>
              </div>';
            }
            if ($_GET['error'] == "E556090" ) {
                echo '<div class="jakili center">
                    <div class="icon">
                    <i class="fa" >&times;</i>
                    </div>
                    <div class="title"><em>Attention!!</em></div><br>
                    <div class="description">
                    Internal Error Please Try Again Later or Contact The PCG TEAM</div><br>
                    <div class="dismiss-btn">
                    <a id="dismiss-popup-btn" href="balance.php" >Go Back to My Wallet</a>
                    </div>
                </div>';
            }
            if ($_GET['error'] == "E5534" ) {
                echo '<div class="jakili center">
                    <div class="icon">
                    <i class="fa" >&times;</i>
                    </div>
                    <div class="title"><em>Attention!!</em></div><br>
                    <div class="description">
                    Wrong PIN please Try again Later</div><br>
                    <div class="dismiss-btn">
                    <a id="dismiss-popup-btn" href="balance.php" >Go Back to My Wallet</a>
                    </div>
                </div>';
            }
            if ($_GET['error'] == "E5530" ) {
                echo '<div class="jakili center">
                    <div class="icon">
                    <i class="fa" >&times;</i>
                    </div>
                    <div class="title"><em>Attention!!</em></div><br>
                    <div class="description">
                    Invalid OR Insufficient PCG please BUY More to Complete Your Request</div><br>
                    <div class="dismiss-btn">
                    <a id="dismiss-popup-btn" href="balance.php" >Go Back to My Wallet</a>
                    </div>
                </div>';
            }
            if ($_GET['error'] == "E5531" ) {
                echo '<div class="jakili center">
                    <div class="icon">
                    <i class="fa" >&times;</i>
                    </div>
                    <div class="title"><em>Attention!!</em></div><br>
                    <div class="description">
                    Invalid Amount</div><br>
                    <div class="dismiss-btn">
                    <a id="dismiss-popup-btn" href="balance.php" >Go Back to My Wallet</a>
                    </div>
                </div>';
            }
            if ($_GET['error'] == "E5532" ) {
                echo '<div class="jakili center">
                    <div class="icon">
                    <i class="fa" >&times;</i>
                    </div>
                    <div class="title"><em>Attention!!</em></div><br>
                    <div class="description">
                    YOU CAN NOT SEND PCG TO YOUR MAIN WALLET</div><br>
                    <div class="dismiss-btn">
                    <a id="dismiss-popup-btn" href="balance.php" >Go Back to My Wallet</a>
                    </div>
                </div>';
            }
            if ($_GET['error'] == "E5533" ) {
                echo '<div class="jakili center">
                    <div class="icon">
                    <i class="fa" >&times;</i>
                    </div>
                    <div class="title"><em>Attention!!</em></div>
                    <div class="description">
                    YOU HAVE SENT TO A WRONG PHYSICIAN BUT NOT TO WORRIES ITS REFUNDED</div><br>
                    <div class="dismiss-btn">
                    <a id="dismiss-popup-btn" href="balance.php" >Go Back to My Wallet</a>
                    </div>
                </div>';
            }
        }
        else if (isset($_GET['success'])) {
            if ($_GET['success'] == "S32225" ) {
              echo '<div class="jakilita center">
                <div class="icon">
                  <i class="fa fa-check"></i>
                </div>
                <div class="title"><em>Success!!</em></div><br>
                <div class="description">
                You have Successifully transfered '; echo $_SESSION['zalatan']; echo' to '; echo  $_SESSION['zugaga']; echo' And You Ref ID is '; echo $_SESSION['fatana']; echo '</div><br>
                <div class="dismiss-btn">
                    <a id="dismiss-popup-btn" href="balance.php" >Go Back to My Wallet</a>
                </div>
              </div>';
            }
          }
        if(isset($_POST['P2Pbtn']))
        {
         $id= $_SESSION['Username'];
  
         $query="SELECT * FROM dns079set WHERE up30set='$id'";
         $query_run=mysqli_query($conn, $query);
         foreach($query_run as $row)
         {
        ?>
        <form action="includes/Transferpcg.inc.php" method="Post">

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="TUser" Placeholder="Enter the Username You Want to Send PCG TO:" class="form-control">
            </div>
            <div class="form-group">
                <label>Transfer Amount</label>
                <input type="text" name="Transfer" Placeholder="Enter the Amount:" class="form-control">
            </div>
            <div class="form-group">
                <label>PIN</label>
                <input type="Password" name="PIN1" Placeholder="Enter the Username Your PIN" class="form-control">
            </div>

            <div class="modal-footer">
                <a href="balance.php" class="btn btn-danger">CANCEL</a>
                <button type="submit" name="TP2P" class="btn btn-primary" >Transfer</button>
            </div>
            <?php
            }
        }
        ?>
        </div>
    </div>
    </div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>