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
    <div class="col-md-2 pull-right logout-container">Welcome <?php echo $_SESSION['user']['name']; ?> <a href="logout.php" class="btn btn-sm btn-danger">Logout</a></div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="page-title">Welcome to the <a href="landing.php">Chicken2Me</a> Shops Portal</div>
        <div class="subscriptions-page-top-text text-center">Welcome to the Chicken2Me subscription page, where you can manage how your business is represented on Chicken2me. </div>
        <div class="shop-form-container">
            <form role="form" id="" class="col-md-12 subs-form">
                <div class="row text-center">
                    <div class="col-md-5">
                        <div class="subs-form-title">Shops that you manage</div>
                    </div>
                    <div class="col-md-7">
                        <div class="subs-form-title">Click on a price plan to be directed to our secure payment screen. A tick icon in the square will be confirmation of your subscription.</div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    if($stmt->rowCount() > 1){
                        $i = 1;
                        while ($row = $stmt->fetch()) {
                    ?>
                            <div class="col-md-5 subs-form-label"><?=$row['shopname'].", ".$row['postcode']?></div>
                            <div class="col-md-7 text-center">
                                <div class="div-one-third">
                                    <div class="subs-form-radio-label">Standard (£35)</div> <input type="radio" name="shop-name<?=$i?>">
                                </div>
                                <div class="div-one-third">
                                    <div class="subs-form-radio-label">Premium (£75)</div> <input type="radio" name="shop-name<?=$i?>">
                                </div>
                                <div class="div-one-third">
                                    <div class="subs-form-radio-label">Ultimate</div> <input type="radio" name="shop-name<?=$i?>" checked="checked">
                                </div>
                            </div>
                    <?php
                        $i++;
                        }
                    }else{
                    ?>
                        <div class="col-md-5 subs-form-label">No Shop Exist</div>
                    <?php
                    }
                    ?>                    
                </div>
                <div class="col-md-12 shop-form-action-container">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6 text-center">
                        <button type="submit" class="btn btn-shop-submit">Save</button>
                        <a href="landing.php" class="btn btn-shop-cancel">Cancel</a>
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>                 
            </form> 
            <div class="landing-page-bottom-title text-center">Click <a href="subscription-intro.php">HERE</a> to learn about the benefits of subscription.</div>
        </div>
    </div>
</div>
<?php include('footer.php');?>
