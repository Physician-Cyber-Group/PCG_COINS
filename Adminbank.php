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
<link href="css/Another.css" rel="stylesheet">
<link rel="stylesheet" href="css/Ano.css">
<?php 
include('includes/header.php');
include('includes/function.php');
include('includes/navbar.php');
if (isset($_POST['124D'])) {
?>
    <div class="container-Fluid">

    <div class="card shadow mb-4">
        <div class="card-header by-3">
            <h6 class="m-0 font-weight-bold text-primary">BANK SELECTED
            </h6>
        <div class="card-body">
            <div class="table-responsive">
            <?php
                $T3625 = 'PCG'. random_numb(9);
                $_SESSION['banngabanga'] = $T3625;

                $selected = $_POST['123D'];
                $_SESSION['MAMA3060'] = $selected;
                $query = "SELECT * FROM assus990pure WHERE assus8775bd='$selected'";
                $query_run = mysqli_query($conn, $query);

            ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <h6 class="descriminanti">Kindly Complete this Transaction By Depositing Your Funds to  the selected Bank Account And Make Sure To Include the Description Below From Your Bank</h6>
                <h6 class="descriptioni">Note: All Deposit Bellow NGN500 Will be Accepted as Contribution To PCG CITY as indicated @ T&C.</h6><br>
                    <thead>
                        <tr>
                            <th>Bank Name</th>
                            <th>Account Name</th>
                            <th>Account Number</th>
                            <th>Description</th>
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
                                <td><?php echo $row['bak69910assus']; ?></td>
                                <td><?php echo $row['zane7998assus']; ?></td>
                                <td><?php echo $row['assus10205ano']; ?></td>
                                <td><?php echo $_SESSION['Username']; echo ' '; echo $T3625; ?></td>
                                <td>
                                    <form action="#" method="post">
                                        <h6  class="btn btn-success">SELECTED</h6>
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

    <form action="includes/user.inc.php" method="Post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Name of Depositor</label>
            <input type="text" name="User" placeholder="Please enter the name on the Account you transfer from" class="form-control">
        </div>
        <div class="form-group">
            <label>Amount</label>
            <input type="text" name="Amount" placeholder="Please enter the Amount of funds you transfer" class="form-control">
        </div>
        <div class="form-group">
            <label>Bank</label>
            <input type="text" name="UserBank" placeholder="Please enter the bank you transfer from" class="form-control">
        </div>

        <div class="form-group">
            <label>Transfer screenshot：</label>
            <input type="file" name="file">
        </div>
        
        <div class="modal-footer">
            <a href="deposit.php" class="btn btn-danger">CANCEL</a>
            <button type="submit" name="recharge" class="btn btn-primary" >SUBMIT</button>
        </div>
    </form>

<?php
} else {
    ?>
    <div class="copyright text-center my-auto">
        <form action="deposit.php" method="post">
            <h6 class="m-0 font-weight-bold text-primary">Please go back and select one of our banks</h6><br>
            <button type="submit" name="124D" style="text-align: center" class="btn btn-success">SELECT BANK TO TRANSFER FUNDS</button>
        </form>
    </div>
    <?php
}
include('includes/scripts.php');
include('includes/footer.php');
?>