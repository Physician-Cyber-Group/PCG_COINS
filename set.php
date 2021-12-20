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
<link href="css/Another.css" rel="stylesheet">
<link rel="stylesheet" href="css/Ano.css">
<?php
include('includes/header.php');
include('includes/navbar.php');
if (isset($_GET['error'])) {
    if ($_GET['error'] == "E3") {
    echo '<div class="ibabu ibabu--visible ibabu--error">There is an existing Physician with this Account record</div>';
    }else if ($_GET['error'] == "E2") {
        echo '<div class="ibabu ibabu--visible ibabu--error">Fill in All Necessary Field</div>';
    }
}
else if (isset($_GET['Bank'])) {
    if ($_GET['Bank'] == "S6" ) {
        echo '<div class="jakilita center">
        <div class="icon">
            <i class="fa fa-check"></i>
        </div>
        <div class="title"><em>Success!!</em></div><br>
        <div class="description">
        You have Successifully Save an Account, Pleas Be Patient as you will be Verified As Soon as Possible</div><br>
        <div class="descriminant">
        If You are not Verified within 24hours you can Contact the <a href="index.php">PCG TEAM</a> 
        </div><br>
        <div class="dismiss-btn">
            <a id="dismiss-popup-btn" href="set.php" >Dismiss</a>
        </div>
        </div>';
    }
}
?>
<link rel="stylesheet" href="css/style.css">
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Bank Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="includes/user.inc.php" method="POST">
            <div class="form-group">
                <label>Bank Account Number</label>
                <input type="text" placeholder="Enter Bank Account Number" name="AcctNum" class="form-control">
            </div>
            <div class="form-group">
                <label>Bank Name</label>
                <select name="CardName" class="form-control">
                    <OPTION>Select Your Bank</OPTION>
                    <OPTION Value="Access Bank">Access Bank</OPTION>
                    <OPTION Value="Access/Diamond">Access/Diamond</OPTION>
                    <OPTION Value="Eco Bank">Eco Bank</OPTION>
                    <OPTION Value="FCMB Bank">FCMB Bank</OPTION>
                    <OPTION Value="Fidelity Bank">Fidelity Bank</OPTION>
                    <OPTION Value="First Bank">First Bank</OPTION>
                    <OPTION Value="GT Bank">GT Bank</OPTION>
                    <OPTION Value="Ja'iz Bank">Ja'iz Bank</OPTION>
                    <OPTION Value="StanbicIBTC">StanbicIBTC</OPTION>
                    <OPTION Value="Sterling Bank">Sterling Bank</OPTION>
                    <OPTION Value="Taj Bank">Taj Bank</OPTION>
                    <OPTION Value="UBA">UBA</OPTION>
                    <OPTION Value="Wema Bank">Wema Bank</OPTION>
                    <OPTION Value="Zenith Bank">Zenith Bank</OPTION>
                </select>
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="Banksave">Save Bank Detail</button>
        </div>
      </form>

    </div>
  </div>
</div>
            <div class="form-group">
                <label>Currency</label>
                <select type="text" placeholder="Naira" class="form-control">
                <Option>Naira</Option>
                <Option>Euro Coming Soon</Option>
                <Option>Dollar Coming Soon</Option>
                </select>
            </div>
            <div class="form-group">
                <label>Bank Card</label>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">Add Bank</button>
            </div>
    <?php
        $Ql =$_SESSION['Username'];
        $query="SELECT * FROM pure788bupa WHERE bupa29zamfara ='$Ql'";
        $query_run=mysqli_query($conn, $query);
        if(mysqli_num_rows($query_run) > 0)
        {
            while($row = mysqli_fetch_assoc($query_run))
            {
    ?>
            <div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Bank Name</th>
                            <th>Bank Account Name</th>
                            <th>Bank Account Number</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $row['bupa60nana']; ?></td>
                            <td><?php echo $row['makwa9887bupa']; ?></td>
                            <td><?php echo $row['zaga70bupa']; ?></td>
                            <td><?php echo $row['kano303bupa']; ?></td>
                        </tr>
                    </tbody>
                </table>
    <?php
            }
        }else {
    ?>
            <div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Bank Name</th>
                            <th>Bank Account Name</th>
                            <th>Bank Account Number</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
            echo "No Record";
    ?>
                    </tbody>
                </table>
    <?php
        }
    ?>
            </div>
            <form action="https://wa.me/message/RVZEY6CVLAG7L1" method="Post">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" >More Functions</button>
                </div>
            </form>
           
        </section>
<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>