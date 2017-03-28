<?php require("assets/config.php"); ?>
<?php include('header.php'); ?>
<?php
// Send Email
if(!empty($_POST)) {    
    // Ensure that the user fills out fields 
    if(empty($_POST['inputShopname'])) 
    { die('<div class="error-message">Please enter a Shop Name.</div>'); }     
    if(!filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL)) 
    { die('<div class="error-message">Empty or Invalid E-Mail Address.</div>'); }
    

    $toEmail = "info@eclecticsolutions.in";
    $subject = "Chicken2Me Signup";

    $message = "\r\nShop Name : " .  $_POST['inputShopname'] . 
               "\r\nE-Mail : " . $_POST['inputEmail'];
    if(!empty($_POST['inputAddress'])) 
    { 
        $message .= "\r\nAddress : " . $_POST['inputAddress'] ;
    }
    if(!empty($_POST['inputCountShop'])) 
    { 
        $message .= "\r\nMultiple Shop option : " . $_POST['inputCountShop'];
    } 

    //Email sent
    $flagEmailSend = mail($toEmail, $subject, $message);
    
    if($flagEmailSend){
        echo '<div class="success-message">Signup Successfully.</div>';
    }
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="page-title">Welcome to the <span>Chicken2Me</span> Shops Portal</div>
        <div class="register-form-container">
            <div class="register-form-text">Thanks for wanting to be a part of chicken2me! All you have to do is enter a few details about your business using the form below. All we need is your email and the address of your shop.  A member of our dedicated shops team will be in contact with you shortly to provide you with login details. We look forward to working with you and helping you reach more chicken lovers than ever before!</div>
            <form role="form" id="signUpForm" class="register-form" action="signup.php" method="post">
                <div class="form-group">                  
                    <input type="text" class="form-control" name="inputShopname" placeholder="Shop or Franchise Name" required>
                </div>
                <div class="form-group">                  
                    <input type="text" class="form-control" name="inputEmail" placeholder="Email" required>
                </div>
                <div class="form-group">                  
                    <textarea class="form-control" name="inputAddress" placeholder="Address"></textarea>
                </div>            
                <div class="form-group">
                    <label class="col-md-5">Do you own multiple shops?</label>
                    <div class="col-md-4 register-form-radio-container">
                        Yes <input type="radio" name="inputCountShop" value="Yes">
                        No <input type="radio" name="inputCountShop" value="No">
                    </div>
                    <button type="submit" class="col-md-3 btn-register-submit pull-right">Send</button>
                </div>                
            </form>
        </div>
    </div>
</div>
<?php include('footer.php');?>
