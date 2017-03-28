<?php require("assets/config.php"); ?>
<?php include('header.php'); ?>
<?php
if( empty($_SESSION['user']) ) {
    echo "<script>window.location.href='http://chicken2medata.com'</script>";
}
?>
<div class="row">
    <div class="col-md-2 pull-right logout-container">Welcome <?php echo $_SESSION['user']['name']; ?> <a href="logout.php" class="btn btn-sm btn-danger">Logout</a></div>
</div>
<?php
$shopid = $_GET['id'];

// Update shop table
if(!empty($_POST)) {    
    // Ensure that the user fills out fields 
    if(empty($_POST['inputShopname'])) 
    { die('<div class="error-message">Please enter a Shop Name.</div>'); } 
    if(empty($_POST['inputAddressline1'])) 
    { die('<div class="error-message">Please enter a Address.</div>'); } 
    if(empty($_POST['inputPostcode'])) 
    { 
        die('<div class="error-message">Please enter a Postcode.</div>'); 
    }else{ 
        if(strlen($_POST['inputPostcode']) > 8)
        {die('<div class="error-message">Please check Postcode lenth.</div>');} 
    }
    if(empty($_POST['inputPhone'])) 
    { die('<div class="error-message">Please enter a Phone.</div>'); } 
    if(empty($_POST['inputMoney'])) 
    { die('<div class="error-message">Please select Money.</div>'); } 

    // update
    $query = "UPDATE shop
            SET shopname = :shopname,
            addressline1 = :addressline1,
            postcode = :postcode,
            phone = :phone,
            money = :money,
            delivery = :delivery,
            halal = :halal
             WHERE shopid = :shopid"; 
    $query_params = array( 
        ':shopname' => $_POST['inputShopname'],
        ':addressline1' => $_POST['inputAddressline1'],
        ':postcode' => $_POST['inputPostcode'], 
        ':phone' => $_POST['inputPhone'], 
        ':money' => $_POST['inputMoney'], 
        ':delivery' => $_POST['inputDelivery'],  
        ':halal' => $_POST['inputHalal'], 
        ':shopid' => $shopid 
    ); 
    try { 
        $stmt = $db->prepare($query); 
        $result = $stmt->execute($query_params); 
    } 
    catch(PDOException $ex){ 
        die("Failed to run query: " . $ex->getMessage()); 
    }
    if($result){
        echo '<div class="success-message">Shop Updated Successfully.</div>';
    }
}

// Fetch value from shop table
$query = "SELECT * FROM shop WHERE shopid = :shopid";
$query_params = array(':shopid' => $shopid); 
try{ 
    $stmt = $db->prepare($query); 
    $result = $stmt->execute($query_params); 
} 
catch(PDOException $ex){ 
    die("Failed to run query: " . $ex->getMessage()); 
} 
$row = $stmt->fetch();

?>
<div class="row">
    <div class="col-md-12">
        <div class="page-title">Welcome to the <a href="landing.php">Chicken2Me</a> Shops Portal</div>
        <div class="shoping-page-top-text text-center">Edit an Existing Shop - Main Info<br/><span><?=$row['shopname'].", ".$row['postcode']?></span></div>
        <div class="shop-form-title text-center">Please use the form below to add a new shop to Chicken2Me. When finished, please click Save.</div>
        <div class="shop-form-container">
            <form role="form" id="editShopForm" class="shop-form" action="edit-shop.php?id=<?=$shopid?>" method="post">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-5 control-label" for="textinput">Shop Name</label>  
                        <div class="col-md-7">
                            <input id="" name="inputShopname" placeholder="Shop Name" class="form-control input-md" required type="text" value="<?=$row['shopname']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label" for="textinput">Address Line 1</label>  
                        <div class="col-md-7">
                            <input id="" name="inputAddressline1" placeholder="Address" class="form-control input-md" required type="text" value="<?=$row['addressline1']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label" for="textinput">Postcode/ZIP</label>  
                        <div class="col-md-7">
                            <input id="" name="inputPostcode" placeholder="Postcode" class="form-control input-md" required type="text" value="<?=$row['postcode']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label" for="textinput">Tel. Number</label>  
                        <div class="col-md-3">
                            <select id="" class="form-control" name="inputCountrycode">
                                <option>Select Country Code</option>
                                <option value="">1</option>
                                <option value="">93</option>
                                <option value="">91</option>
                            </select>
                        </div>
                        <div class="col-md-4 pull-right">
                            <input id="" name="inputPhone" placeholder="Phone" class="form-control input-md" required type="text"  value="<?=$row['phone']?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-5 control-label" for="textinput">Price</label>  
                        <div class="col-md-7">
                            <select id="" class="form-control" name="inputMoney" required>
                                <option>Select Price</option>
                                <option value="1" <?php if($row['money'] == 1){echo 'selected="selected"';} ?> >£</option>
                                <option value="2" <?php if($row['money'] == 2){echo 'selected="selected"';} ?> >££</option>
                                <option value="3" <?php if($row['money'] == 3){echo 'selected="selected"';} ?> >£££</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label" for="textinput">Delivery?</label>  
                        <div class="col-md-7">
                            <select id="" class="form-control" name="inputDelivery">
                                <option>Select Delivery</option>
                                <option value="1" <?php if(1 == $row['delivery']) {echo 'selected="selected"'; }?>>Yes</option>
                                <option value="0" <?php if(0 == $row['delivery']) {echo 'selected="selected"'; }?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label" for="textinput">Halal?</label>  
                        <div class="col-md-7">
                            <select id="" class="form-control" name="inputHalal">
                                <option>Select Halal</option>
                                <option value="1" <?php if(1 == $row['halal']) {echo 'selected="selected"'; }?>>Yes</option>
                                <option value="0" <?php if(0 == $row['halal']) {echo 'selected="selected"'; }?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <a href="add-edit-opening-times.php?id=<?=$shopid?>" class="shop-link-btn">>Click here to edit your customers your shop's opening times
                        </a>
                    </div>
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
        </div>
    </div>
</div>
<?php include('footer.php');?>
