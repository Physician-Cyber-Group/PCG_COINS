<?php
session_start();

if(isset($_SESSION['Username'])){
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

    <div class="container-Fluid">

    <div class="card shadow mb-4">
        <div class="card-header by-3">
            <h6 class="m-0 font-weight-bold text-primary">Transfer</h6>
        </div>
        <div class="card-body">
        <?php
        $Connection = mysqli_connect("localhost","root", "", "pcg_coins_test1");
        if(isset($_POST['P2Pbtn']))
        {
         $id= $_POST['P2P'];
  
         $query="SELECT * FROM Admin WHERE Username='$id'";
         $query_run=mysqli_query($Connection, $query);
         foreach($query_run as $row)
         {
        ?>
        <form action="includes/NairaReserve.inc.php" method="Post">

            <input type="text" name="P2P" value="<?php echo $row['Username']; ?>">
            <input type="text" name="P2P2" value="<?php echo $row['NairaCurrencyReserve']; ?>">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="TUser" Placeholder="Enter the Username You Want to Send PCG TO:" class="form-control">
            </div>
            <div class="form-group">
                <label>Transfer Amount</label>
                <input type="text" name="Transfer" class="form-control">
            </div>
            <div class="form-group">
                <label>PIN</label>
                <input type="Password" name="PIN1" class="form-control">
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