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
    header("Location: login.php?ddd");
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['Username']);
    header("Location: login.php?fff");
}
?>
<?php 
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="modal fade" id="addadminprofile" tabindex="+1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Letest News From Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <div class="form-group">
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
            </div>
        </div>
    </div>
  </div>
</div>
                <div class="container-fluid">
                <?php if (isset($_SESSION['Success'])) : ?>
                <div>
                    <h3>
                        <?php
                        echo $_SESSION['Success'];
                        unset($_SESSION['Success']);
                        ?>
                    </h3>
                </div>
                <?php endif ?>
                
                <h3 style="font-style: italic; color: #000; font-family: Georgia, 'Times New Roman', Times, serif;"> Welcome Physician, <strong><?php echo $_SESSION['Username']; ?></strong></h3><br>
                <h1 style="text-align: right; font-style: italic; font-size: 20px; font-family: Georgia, 'Times New Roman', Times, serif;" class="h3 mb-0 text-gray-800"> Your Invitation Code is <strong style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;" ><?php echo $_SESSION['uidUsers']; ?></strong> You Can invite More relatives to benefit more.</h1><hr>

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="Myteam.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> My Team</a>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                                    POP NEWS
                                    </button>
                    </div>
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
                                                Extimation in NGN</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                                $query = "SELECT * FROM dns079set WHERE up30set='$QL'";
                                                $query_run = mysqli_query($conn, $query);
                                                $query1 = "SELECT * FROM full001pure";
                                                $query_run1 = mysqli_query($conn, $query1);
                                                if(mysqli_num_rows($query_run) > 0 || mysqli_num_rows($query_run1) > 0) {
                                                while($row = mysqli_fetch_assoc($query_run))
                                                {
                                                    $row1 = mysqli_fetch_assoc($query_run1);
                                                    echo $row['dns10pba']*$row1['pure684pn'];
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
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-Success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                LAST PCG Amount in Naira</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                                $query = "SELECT * FROM full001pure";
                                                $query_run = mysqli_query($conn, $query);
                                                if(mysqli_num_rows($query_run) > 0) {
                                                while($row = mysqli_fetch_assoc($query_run))
                                                {
                                                    echo $row['pure8978pn'];
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
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    WITHDRAWABLE CURRENCY</div>
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

                    <!-- Content Row -->


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">PCG CHART</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                    <hr>
                                    PCG Trends with respect to transctions and Market Price
                                    <code>The Higher demand the Higher the price</code> and vice varser.
                                </div>
                            </div>

            


    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>
    
    

    
