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

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/Astyle.css">
<link rel="stylesheet" href="css/Bstyle.css">
<link rel="stylesheet" href="css/amarya.css">
<div class="container-Fluid">

<div class="card shadow mb-4">
    <div class="card-header by-3 anog">
        <div class="ango">
            <h6 class="m-0 font-weight-bold text-primary highlight">TRANSACTION HISTORY
            </h6>
        </div>
        <nav>
            <ul>
                <li class="curent"><a href="#">AUTOMATIC TRANSACTION</a></li>
                <li><a href="Transactiona.php">DEPOSIT TRANSACTION</a></li>
                <li ><a href="Transactionb.php">WITHDRAWAL TRANSACTION</a></li>
            </ul>
        </nav>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <?php
            $Ql =$_SESSION['Username'];
            $query = "SELECT * FROM mada999tau WHERE mada1300phy='$Ql' ";
            $query_run = mysqli_query($conn, $query);

        ?>
        
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>TIME/DATE</th>
                        <th>TRANSACTION REF</th>
                        <th>TRANSACTION TYPE</th>
                        <th>CURRENCY AMOUNT</th>
                        <th>FROM-TO-</th>
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
                            <td><?php echo $row['fasfic3060mada']; ?></td>
                            <td><?php echo $row['elus9160mada']; ?></td>
                            <td><?php echo $row['zam19tau']; ?></td>
                            <td><?php echo $row['amo7080tau']; ?></td>
                            <td><?php echo $row['ban88nema']; ?></td>
                        </tr>
                        <?php
                        }

                    }
                    else {
                        echo "There are No History to display";
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