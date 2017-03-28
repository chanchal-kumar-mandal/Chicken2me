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

// 7 days loop
$daysArray = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

// 24 hrs. tme loop
$timesArray = array();
for($i=0; $i<24; $i++){
    $timesArray[number_format($i, 2, '.', '')] = number_format($i, 2, ':', '');
}

// Update shop table
if(!empty($_POST)) { 

    $query_string = "";
    //$query_params_string = "";

    $query_params = array();
    $flgOneInput = 0;
    for($i=0; $i<7; $i++){

        $inputOVar = 'inputOp_'.$i;
        $fieldOVar = 'op_'.$i;
        $inputCVar = 'inputCl_'.$i;
        $fieldCVar = 'cl_'.$i;

        if(!empty($_POST[$inputOVar])){
            $query_string .= ' '.$fieldOVar.' = :'.$fieldOVar.',';
            $query_params[':'.$fieldOVar] = $_POST[$inputOVar];
            $flgOneInput = 1;
        } 
        if(!empty($_POST[$inputCVar])){
            $query_string .= ' '.$fieldCVar.' = :'.$fieldCVar.',';
            $query_params[':'.$fieldCVar] = $_POST[$inputCVar];
            $flgOneInput = 1;
        }
    }
    if($flgOneInput == 0){ 
        die('<div class="error-message">Please Select Time.</div>');
    }

    // remove last string "," from query string
    $query_string = substr($query_string, 0, -1);

    // Add shopid into query_params array
    $query_params[':shopid'] = $shopid;

    // update shop
    $query = "UPDATE shop SET ".$query_string." WHERE shopid = :shopid";
            
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
        <div class="shoping-page-top-text text-center">Add/Edit Opening Times<br/><span><?=$row['shopname'].", ".$row['postcode']?></span></span></div>    
        <div class="opening-times-form-container">
            <div class="shop-form-title text-center">Please use the form below to update your shops opening times. When finished, please click Save.</div>
            <form role="form" id="addEditOpeningForm" class="shop-form" action="add-edit-opening-times.php?id=<?=$shopid?>" method="post">
                <div class="col-md-6">
                    <?php
                    for($o=0; $o<7; $o++){
                    ?>
                        <div class="form-group">
                            <label class="col-md-7 control-label" for="textinput"><?=$daysArray[$o]?> Opening Time</label>  
                            <div class="col-md-5">
                                <select id="" class="form-control" name="inputOp_<?=$o?>">
                                    <option value="">Select Time</option>
                                    <?php
                                    $field_name = "op_" . $o;
                                    foreach ($timesArray as $key => $value) {
                                        echo '<option value="'.$key.'" '.(($key == $row[$field_name])? 'selected="selected"' : '').'>'.$value.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-md-6">
                    <?php
                    for($c=0; $c<7; $c++){
                    ?>
                        <div class="form-group">
                            <label class="col-md-7 control-label" for="textinput"><?=$daysArray[$c]?> Closing Time</label>  
                            <div class="col-md-5">
                                <select id="" class="form-control" name="inputCl_<?=$c?>">
                                    <option value="">Select Time</option>
                                    <?php
                                    $field_name = "cl_" . $c;
                                    foreach ($timesArray as $key => $value) {
                                        echo '<option value="'.$key.'" '.(($key == $row[$field_name])? 'selected="selected"' : '').'>'.$value.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
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
        </div>
    </div>
</div>
<?php include('footer.php');?>
