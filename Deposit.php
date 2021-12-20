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
    if ($_GET['error'] == "E356086") {
    echo '<div class="ibabu ibabu--visible ibabu--error">Fill in All Necessary Field</div>';
    }
    else if ($_GET['error'] == "E356088") {
    echo '<div class="ibabu ibabu--visible ibabu--error">An Error Has Occured! You Can Contact the PCG Team for Help!</div>';
    }
    else if ($_GET['error'] == "E356089") {
    echo '<p class="ibabu ibabu--visible ibabu--error">Invalid Proof Size! You Can only upload a proof from 2mb</p>';
    }
    else if ($_GET['error'] == "E356090") {
    echo '<p class="ibabu ibabu--visible ibabu--error">Random Error From the File! Please Redownload/Rescreenshot the file and Submit Again</p>';
    }
    else if ($_GET['error'] == "E356091") {
    echo '<p class="ibabu ibabu--visible ibabu--error">Invalid File! We Only Accept jpg,png,jpeg,pdf files.</p>';
    }
}
else if (isset($_GET['Upload'])) {
    if ($_GET['Upload'] == "S356087" ) {
        echo '<div class="jakilita center">
        <div class="icon">
            <i class="fa fa-check"></i>
        </div>
        <div class="title"><em>Success!!</em></div><br>
        <div class="description">
        You have Successifully Sent A Deposit Request, Pleas Be Patient as you will be Credited As Soon as Possible</div>
        <div class="descriminant">
        Make Sure You Include the Descrition Given to you from your Bank Deposit As it leads to lost of funds.
        You Cannot Submit an Already or duplicate Deposit as it leads to Section A of Our <a href="index.php">T & C</a> 
        </div><br>
        <div class="dismiss-btn">
            <a id="dismiss-popup-btn" href="balance.php" >Dismiss</a>
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
            $query = "SELECT * FROM assus990pure";
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
                            <td><?php echo $row['bak69910assus']; ?></td>
                            <td><?php echo $row['zane7998assus']; ?></td>
                            <td><?php echo $row['assus10205ano']; ?></td>
                            <td>
                                <form action="Adminbank.php" method="post">
                                    <input type="hidden" readonly="readonly" name="123D" value="<?php echo $row['assus8775bd']; ?>">
                                    <button type="submit" name="124D" class="btn btn-success">SELECT</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                        }

                    }
                    else {
                        echo "There is Temporarily No Bank Account Please Contact the Customer Care For more information";
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