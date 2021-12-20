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
<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == "E33895" ) {
        echo '<div class="jakili center">
        <div class="icon">
            <i class="fa" >&times;</i>
        </div>
        <div class="title"><em>Attention!!</em></div><br>
        <div class="description">
        All Fields Must Not Be Empty Please Fill all necessary Fields Or Contact The PCG TEAM</div><br>
        <div class="dismiss-btn">
            <a id="dismiss-popup-btn" href="balance.php" >Dismiss</a>
        </div>
        </div>';
    }
    if ($_GET['error'] == "E33899" ) {
        echo '<div class="jakili center">
            <div class="icon">
            <i class="fa" >&times;</i>
            </div>
            <div class="title"><em>Attention!!</em></div><br>
            <div class="description">
            Internal Error Please Try Again Later or Contact The PCG TEAM</div><br>
            <div class="dismiss-btn">
            <a id="dismiss-popup-btn" href="balance.php" >Dismiss</a>
            </div>
        </div>';
    }
    if ($_GET['error'] == "E33900" ) {
        echo '<div class="jakili center">
            <div class="icon">
            <i class="fa" >&times;</i>
            </div>
            <div class="title"><em>Attention!!</em></div><br>
            <div class="description">
            Invalid OR Insufficient PCG Wallet please  Buy More PCG to Complete Your Request</div><br>
            <div class="dismiss-btn">
            <a id="dismiss-popup-btn" href="balance.php" >Dismiss</a>
            </div>
        </div>';
    }
    if ($_GET['error'] == "E33896" ) {
        echo '<div class="jakili center">
            <div class="icon">
            <i class="fa" >&times;</i>
            </div>
            <div class="title"><em>Attention!!</em></div><br>
            <div class="description">
            Invalid OR Insufficient Withdrawable Wallet please  Make Deposit to Complete Your Request</div><br>
            <div class="dismiss-btn">
            <a id="dismiss-popup-btn" href="balance.php" >Dismiss</a>
            </div>
        </div>';
    }
    if ($_GET['error'] == "E33897" ) {
        echo '<div class="jakili center">
            <div class="icon">
            <i class="fa" >&times;</i>
            </div>
            <div class="title"><em>Attention!!</em></div><br>
            <div class="description">
            Invalid Purchase Amount You Can Only Buy PCG From a Minimum of NGN500</div><br>
            <div class="dismiss-btn">
            <a id="dismiss-popup-btn" href="balance.php" >Dismiss</a>
            </div>
        </div>';
    }
    if ($_GET['error'] == "E33901" ) {
        echo '<div class="jakili center">
            <div class="icon">
            <i class="fa" >&times;</i>
            </div>
            <div class="title"><em>Attention!!</em></div><br>
            <div class="description">
            Invalid Sell Amount You Can Only Sell PCG From a Minimum of PCG20</div><br>
            <div class="dismiss-btn">
            <a id="dismiss-popup-btn" href="balance.php" >Dismiss</a>
            </div>
        </div>';
    }
    if ($_GET['error'] == "E5532" ) {
        echo '<div class="jaja center">
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
        echo '<div class="jaja center">
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
    if ($_GET['success'] == "S33898" ) {
        echo '<div class="jakilita center">
        <div class="icon">
            <i class="fa fa-check"></i>
        </div>
        <div class="title"><em>Success!!</em></div><br>
        <div class="description">
        You have Successifully Purchased '; echo 'PCG'; echo $_SESSION['zugga']; echo' At '; echo  $_SESSION['zaltan']; echo' and You Ref ID is '; echo $_SESSION['fatna']; echo '</div><br>
        <div class="dismiss-btn">
            <a id="dismiss-popup-btn" href="balance.php" >Dismiss</a>
        </div>
        </div>';
    }
    if ($_GET['success'] == "S33902" ) {
        echo '<div class="jakilita center">
        <div class="icon">
            <i class="fa fa-check"></i>
        </div>
        <div class="title"><em>Success!!</em></div><br>
        <div class="description">
        You have Successifully Sold '; echo $_SESSION['zatan']; echo' At '; echo 'NGN'; echo  $_SESSION['zuga']; echo' and You Ref ID is '; echo $_SESSION['fana']; echo '</div><br>
        <div class="dismiss-btn">
            <a id="dismiss-popup-btn" href="balance.php" >Dismiss</a>
        </div>
        </div>';
    }
    }
    ?>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/Fstyle.css">
<link rel="stylesheet" href="css/Another.css">
<link rel="stylesheet" href="css/Ano.css">
<link rel="stylesheet" href="css/D50000.css">
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">BUY AND SELL PCG</h1>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            PCG COINS AMOUNT</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php
                            $query = "SELECT * FROM dns079set WHERE up30set='$QL'";
                            $query_run = mysqli_query($conn, $query);
                            if(mysqli_num_rows($query_run) > 0) {
                             while($row = mysqli_fetch_assoc($query_run))
                             {
                                echo $row['dns10pba'];
                             }
                            }

                        ?>
                        <?php
                            echo '<h4>PCG<h4>';
                        ?>
                        </div>
                    </div>
                </div>
                <div>
                    <form action="Transferpcg.php" method="post">
                        <button type="submit" name="P2Pbtn" class="btn btn-success">Transfer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">PCG IN NAIRA
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                <?php
                                    $query = "SELECT * FROM full001pure";
                                    $query_run = mysqli_query($conn, $query);
                                    if(mysqli_num_rows($query_run) > 0) {
                                    while($row = mysqli_fetch_assoc($query_run))
                                    {
                                        echo $row['pure684pn'];
                                    }
                                    }

                                ?>
                                <?php
                                    echo '<h4>NGN<h4>';
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            WITHDRAWABLE CASH</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php
                            $query = "SELECT * FROM dns079set WHERE up30set='$QL'";
                            $query_run = mysqli_query($conn, $query);
                            if(mysqli_num_rows($query_run) > 0) {
                             while($row = mysqli_fetch_assoc($query_run))
                             {
                                echo $row['nba1010set'];
                             }
                            }

                        ?>
                        <?php
                            echo '<h4>NGN<h4>';
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    if(isset($_POST['#']))
    {
    }
    else {
        $id= $_SESSION['Username'];
        $query="SELECT * FROM dns079set WHERE up30set='$id'";
        $query_run=mysqli_query($conn, $query);
        foreach($query_run as $row)
        {
    ?>
<li class="nav-item dropdown no-arrow mx-1">
    <a class="helpEE btn" class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>BUY PCG
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="userDropdown">
        <form action="includes/buy.inc.php" method="Post">
            <input readonly="readonly" type="hidden" name="refer" value="<?php echo $row['icg5set']; ?>">
            <div class="form-group">
                <label>Amount in NGN</label>
                <input type="text" name="buyAmount" Placeholder="Enter the Amount:" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="submit" name="buy" class="btn btn-primary" >BUY</button>
            </div>
        </form>
    </div><br><br>
</li>
<li class="nav-item dropdown no-arrow mx-1">
    <a class="helpaE btn" class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>SELL PCG
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="userDropdown">
        <form action="includes/sell.inc.php" method="Post">
            <input type="hidden" readonly="readonly" name="refer" value="<?php echo $row['icg5set']; ?>">
            <div class="form-group">
                <label>Amount in PCG</label>
                <input type="text" name="sellAmount" Placeholder="Enter the Amount:" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="submit" name="sell" class="btn btn-primary" >SELL</button>
            </div>
        </form>
    </div>
</li>
<?php
        }
    }
?>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>