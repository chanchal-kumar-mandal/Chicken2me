<?php require("assets/config.php"); ?>
<?php include('header.php'); ?>
<?php
if( empty($_SESSION['user']) ) {
    echo "<script>window.location.href='http://chicken2medata.com'</script>";
}

$query = "SELECT * FROM shop WHERE userid = :userid";
$query_params = array(':userid' => $_SESSION['user']['userid']); 
try{ 
    $stmt = $db->prepare($query); 
    $result = $stmt->execute($query_params); 
} 
catch(PDOException $ex){ 
    die("Failed to run query: " . $ex->getMessage()); 
}

?>
<div class="row">
    <div class="col-md-offset-10 col-md-2 logout-container">Welcome <?php echo $_SESSION['user']['name']; ?> <a href="logout.php" class="btn btn-sm btn-danger">Logout</a></div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="page-title">Welcome to the <span>Chicken2Me</span> Shops Portal</div>
        <div class="landing-page-top-text text-center">Thanks for logging into the Chicken2me portal!  What would you like to do today? </div>
        <div class="landing-menu-container">
            <?php
            if($stmt->rowCount() > 1){
                while ($row = $stmt->fetch()) {
                    echo '<a href="edit-shop.php?id='.$row['shopid'].'" class="landing-menu">Edit '.$row['shopname'].'</a>';
                }
            }
            ?>
            <a href="add-shop.php" class="landing-menu">Add a new shop to Chicken2me</a>
            <a href="subscriptions.php" class="landing-menu">Manage shop subscriptions</a>     
            <a href="subscription-intro.php" class="landing-menu">How to sign up</a>
            <a href="subscriptions.php" class="landing-menu">Account Settings</a>     
        </div>
        <div class="landing-page-bottom-title text-center">Have any questions? Contact us <a href="signup.php">here</a>.</div>
    </div>
</div>
<?php include('footer.php');?>