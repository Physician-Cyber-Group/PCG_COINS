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
    exit();
}
?>
<?php 
include('includes/header.php');
include('includes/navbar.php');
if (isset($_POST['2356G'])) {
?>
    <div class="container-Fluid">

    <div class="card shadow mb-4">
        <div class="card-header by-3">
            <h6 class="m-0 font-weight-bold text-primary">BANK SELECTED
            </h6>
        <div class="card-body">
            <div class="table-responsive">
            <?php
                $selected = $_POST['2356H'];
                $_SESSION['DAGADAGA'] = $_POST['2356H'];

                $query = "SELECT * FROM pure788bupa WHERE bupa339gwale='$selected'";
                $query_run = mysqli_query($conn, $query);

            ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <h6 class="m-0 font-weight-bold text-secondary">You are Trying To Submit a Withdrawal Request To the Bellow Selected Bank</h6><br>
                    <thead>
                        <tr>
                            <th>Bank Name</th>
                            <th>Account Name</th>
                            <th>Account Number</th>
                            <th>SELECTED</th>
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
<form action="includes/user.inc.php" method="Post">
                                        <h6  class="btn btn-success">SELECTED</h6>
                                        <input type="hidden" name="235669B" value="<?php echo $row['bupa60nana']; ?>  <?php echo $row['zaga70bupa']; ?>">
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
    $selectedz= $_SESSION['Username'];
    $queryz = "SELECT * FROM dns079set WHERE up30set ='$selectedz'";
    $query_runz = mysqli_query($conn, $queryz);
    if(mysqli_num_rows($query_runz) > 0)
    {
        while($rowz = mysqli_fetch_assoc($query_runz))
        {
    ?>
    <h6 class="m-0 font-weight-bold text-primary">Our Minimum Withdrawal Is NGN1000 and we don't have a maximum as You Can Withdraw as long as You Have Sufficient Funds</h6><br>
    <div class="form-group">
        <label>Amount</label>
        <input type="text" name="AmountW" placeholder="Enter the Amount You Intend To Withdraw" class="form-control">
    </div>
    <div class="form-group">
        <label>PIN</label>
        <input type="Password" name="PINW" placeholder="Enter Your PIN to Withdraw Your Funds" class="form-control">
    </div>
    <div class="modal-footer">
        <a href="Withdraw.php" class="btn btn-danger">CANCEL</a>
        <button type="submit" name="Withdraw" class="btn btn-primary" >SUBMIT</button>
    </div>

<?php
        }

    }
    else {
?>
        <div class="copyright text-center my-auto">
            <form action="Withdraw.php" method="post">
                <h6 class="m-0 font-weight-bold text-primary">Invalid Username, If Still Dont Work Please Contact the PCG TEAM</h6><br>
                <button type="submit" name="124D" style="text-align: center" class="btn btn-success">Try Again</button>
            </form>
        </div>
<?php
    }
} else {
    ?>
    <div class="copyright text-center my-auto">
        <form action="Withdraw.php" method="post">
            <h6 class="m-0 font-weight-bold text-primary">Please go back and select one of our banks</h6><br>
            <button type="submit" name="124D" style="text-align: center" class="btn btn-success">SELECT BANK TO WITHDRAW FUNDS</button>
        </form>
    </div>
    <?php
}
include('includes/scripts.php');
include('includes/footer.php');
?>