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
<link href="css/Another.css" rel="stylesheet">
<link rel="stylesheet" href="css/Ano.css">
<div class="container-Fluid">
<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == "E3560") {
    echo '<div class="ibabu ibabu--visible ibabu--error">Fill in All Necessary Field</div>';
    }
    else if ($_GET['error'] == "E3561") {
    echo '<div class="ibabu ibabu--visible ibabu--error">Wrong PIN! You Can Contact the PCG Team for Help!</div>';
    }
    else if ($_GET['error'] == "E3562") {
    echo '<p class="ibabu ibabu--visible ibabu--error">Internal Error! You Can Contact the PCG Team for Help</p>';
    }
    else if ($_GET['error'] == "E3563") {
    echo '<p class="ibabu ibabu--visible ibabu--error">Insufficient Funds! Please Sell Your PCG Or Redeposit To Complete this Request</p>';
    }
    else if ($_GET['error'] == "E3564") {
    echo '<p class="ibabu ibabu--visible ibabu--error">Invalid Amount! We Only Accept a minimum Withdrawal of NGN1,000.</p>';
    }
}
else if (isset($_GET['success'])) {
    if ($_GET['success'] == "S3565" ) {
        echo '<div class="jakilita center">
        <div class="icon">
            <i class="fa fa-check"></i>
        </div>
        <div class="title"><em>Success!!</em></div><br>
        <div class="description">
        You have Successifully Sent A Withdrawal Request, Pleas Be Patient as you will be Credited As Soon as Possible</div><br>
        <div class="descriminant">
        If You did not Recieve your Funds within 24hours you can Contact the <a href="index.php">PCG TEAM</a> 
        </div><br>
        <div class="dismiss-btn">
            <a id="dismiss-popup-btn" href="Withdraw.php" >Dismiss</a>
        </div>
        </div>';
    }
}
?>
<div class="card shadow mb-4">
    <div class="card-header by-3">
        <h6 class="m-0 font-weight-bold text-primary">SELECT BANK
        </h6>
        <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "EmptyFields") {
                echo '<p class="pop">Fill in All empty Field</p>';
                }
            }
            else if(isset($_SESSION['success']) && $_SESSION['success'] !='')
            {
                echo '<h2>' .$_SESSION['success'].'</h2>';
                unset($_SESSION['success']);
            }
            else if(isset($_SESSION['Status']) && $_SESSION['Status'] !='')
            {
                echo '<h2>' .$_SESSION['Status'].'</h2>';
                unset($_SESSION['Status']);
            }
        ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <?php
            $Ql =$_SESSION['Username'];
            $query = "SELECT * FROM pure788bupa WHERE bupa29zamfara='$Ql'";
            $query_run = mysqli_query($conn, $query);

        ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Bank Name</th>
                        <th>Account Name</th>
                        <th>Account Number</th>
                        <th>SELECT</th>
                    </tr>
                </thead>
                <tbody>
                

                <?php

                    if(mysqli_num_rows($query_run) > 0)
                    {
                        while($row = mysqli_fetch_assoc($query_run))
                        {
                            ?>
                        <tr>
                            <td><?php echo $row['bupa60nana']; ?></td>
                            <td><?php echo $row['makwa9887bupa']; ?></td>
                            <td><?php echo $row['zaga70bupa']; ?></td>
                            <td>
                                <form action="Userbank.php" method="post">
                                    <input readonly="readonly" type="hidden" name="2356H" value="<?php echo $row['bupa339gwale']; ?>">
                                    <button type="submit" name="2356G" class="btn btn-success">SELECT</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                        }

                    }
                    else {
                        echo "There are No Account To Select Go To Settings To Add Your Bank Account";
                    }
                ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>