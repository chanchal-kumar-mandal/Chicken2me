<?php require("assets/config.php"); ?>
<?php include('header.php'); ?>
<?php
if(!empty($_POST)) {

    // Ensure that the user fills out correct email
    if(!filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL)) 
    { 
        die('<div class="error-message">Empty or Invalid E-Mail Address.</div>'); 
    } 

    $useremail = $_POST['inputEmail'];

    // Check user email existance
    $query = "SELECT * FROM shop_user WHERE useremail = :useremail"; 
    $query_params = array( ':useremail' => $useremail ); 
    try { 
        $stmtEmailCheck = $db->prepare($query); 
        $resultEmailCheck = $stmtEmailCheck->execute($query_params); 
    } 
    catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
    if($stmtEmailCheck->rowCount() == 0){ die('<div class="error-message">This email is not registered.</div>'); }

    $row = $stmtEmailCheck->fetch(); 
    $userid = $row['userid'];
    // Update password in shop_user 
    $query = "UPDATE shop_user 
            SET password = :password,
            salt = :salt
            WHERE userid = :userid
            AND useremail = :useremail";
     
    //Password generation
    function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $alphabetArr = str_split($alphabet);
        $passString = "";
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, strlen($alphabet)-1);
            $passString .= $alphabetArr[$n];
        }
        return $passString;
    }

    $userpassword = randomPassword();

    // Security measures
    $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
    $password = hash('sha256', $userpassword . $salt); 
    for($round = 0; $round < 65536; $round++){ 
        $password = hash('sha256', $password . $salt); 
    }
    $query_params = array( 
        ':password' => $password, 
        ':salt' => $salt,
        ':userid' => $userid,
        ':useremail' => $useremail
    ); 
    try {  
        $stmt = $db->prepare($query); 
        $result = $stmt->execute($query_params); 
    } 
    catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
    
    if($result) {

        $toEmail = $useremail;
        $subject = "New Password For Chicken2Me ";

        $message = "\r\nNew Password : " .  $userpassword;

        //Email sent
        $flagEmailSend = mail($toEmail, $subject, $message);
        
        if($flagEmailSend){
            echo '<div class="success-message">Password send successfully.</div>';
        }
    } 
}

?>
<div class="row">
    <div class="col-md-12">
        <div class="page-title">Welcome to the <span>Chicken2Me</span> Shops Portal</div>
        <div class="login-form-container">
            <div class="password-form-content">
                <div class="login-form-title text-center">Forgot Password?</div>
                <div class="login-form-text text-center">Please enter your email address in the box and we will send instructions to you as to how you can log back in.</div>
                <form role="form" id="forgotPasswordForm" class="login-form" action="forgot-password.php" method="post">
                    <div class="form-group">                  
                        <input type="text" class="form-control" name="inputEmail" placeholder="Email">
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-forgot-submit">Send</button>
                    </div>                   
                </form>            
            </div>
        </div>
    </div>
</div>
<?php include('footer.php');?>
