<?php
session_start();

if(isset($_SESSION['Username'])){
    require 'includes/dbh.inc.php';
    $QL = $_SESSION['Username'];
    $query = "SELECT * FROM dns079set WHERE up30set ='$QL' ";
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
<li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
    <?php
        $Ql =$_SESSION['Username'];
        $query="SELECT * FROM dns079set WHERE up30set ='$Ql'";
        $query_run=mysqli_query($conn, $query);
        foreach($query_run as $row)
        {
    ?>

            <div id="boxes">
                <?php
                    $R101144 = "Male";
                    $R102188 = "Female";
                    if ($R101144 == $row['gmn459dns']) {
                        echo '<img style="width: 30%; margin-left: 50%; margin-right: 50%; text-align:center; background-color: #333; padding: 50px;" class="img-profile rounded-circle"  src="img/undraw_profile.svg"><br>';
                    }else if ($R102188 == $row['gmn459dns']) {
                        echo '<img style="width: 30%; margin-left: 50%; margin-right: 50%; text-align:center; background-color: #333; padding: 50px;" class="img-profile rounded-circle"  src="img/undraw_profile_1.svg"><br>';
                    }else {
                        echo '<img style="width: 30%; margin-left: 50%; margin-right: 50%; text-align:center; background-color: #333; padding: 50px;" class="img-profile rounded-circle"  src="img/Bestlogo.png"><br>';
                    }
                ?>
            </div>
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" readonly='readonly' value='<?php echo $row['sm897dns']; ?> <?php echo $row['set598fs']; ?> <?php echo $row['set333os']; ?>' >
            </div>
            <div class="form-group">
                <label>Invitation Code</label>
                <input readonly='readonly'  class="form-control" value='<?php echo $row['uid30set']; ?>'>
            </div>
            
            <div class="form-group">
                <label>Username</label>
                <input readonly='readonly' class="form-control" value='<?php echo $row['up30set']; ?>'>
                </select>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input readonly='readonly' class="form-control" value='<?php echo $row['maga90e']; ?>'>
                </select>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input readonly='readonly' class="form-control" value='<?php echo $row['pnb36kr']; ?>'>
                </select>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <input readonly='readonly' class="form-control" value='<?php echo $row['gmn459dns']; ?>'>
                </select>
            </div>
            <div class="form-group">
                <label>Birthdate</label>
                <input readonly='readonly' class="form-control" value='<?php echo $row['dns7879bh']; ?>'>
                </select>
            </div>
            <div class="form-group">
                <label>Date Of Register</label>
                <input readonly='readonly' class="form-control" value='<?php echo $row['dns2dr']; ?>'>
                </select>
            </div>
            <form action="" method="Post">
                <div class="modal-footer">
                    <a type="submit" href="https://wa.me/message/RVZEY6CVLAG7L1" name="buy" class="btn btn-primary" >EDIT</a>
                </div>
            </form>
           
        </section>
        <?php
        }
        ?>
    </a>
</li>
<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>