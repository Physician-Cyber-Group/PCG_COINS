<?php
session_start();
if(isset($_SESSION['Username'])){
    
    $QL = $_SESSION['Username'];
    $Connection = mysqli_connect("localhost","root", "", "pcg_coins_test1");
    $query = "SELECT * FROM Users WHERE Username='$QL' ";
    $query_run = mysqli_query($Connection, $query);
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
<div class="container-Fluid">

<div class="card shadow mb-4">
    <div class="card-header by-3">
        <h6 class="m-0 font-weight-bold text-primary">TRANSACTION HISTORY
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <?php
            $Connection = mysqli_connect("localhost","root", "", "pcg_coins_test1");
            $Ql =$_SESSION['uidUsers'];
            $query = "SELECT * FROM Users WHERE invitationCode='$Ql'";
            $query_run = mysqli_query($Connection, $query);

        ?>
        
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>TIME/DATE</th>
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
                            <td><?php echo $row['Surname']; ?> <?php echo $row['First_Name']; ?> <?php echo $row['Other_Names']; ?></td>
                            <td><?php echo $row['Date']; ?></td>
                        </tr>
                        <?php
                        }

                    }
                    else {
                        echo "You Have No Invitee Try and Invite Using Your Invitation Code as it boost Your Account!";
                    }
                ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
<?php
include('includes/footer.php');
?>
