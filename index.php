<?php require("assets/config.php"); ?>
<?php
    $submitted_email = ''; 
    if(!empty($_POST)){ 
        $query = "SELECT userid, name, useremail, password, salt FROM shop_user WHERE useremail = :useremail";
        $query_params = array( 
            ':useremail' => $_POST['inputEmail'] 
        ); 
        try{ 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        }
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        $login_ok = false; 
        $row = $stmt->fetch(); 
        
        if($row){ 
            $check_password = hash('sha256', $_POST['inputPassword'] . $row['salt']); 
            for($round = 0; $round < 65536; $round++){
                $check_password = hash('sha256', $check_password . $row['salt']);
            } 
            if($check_password === $row['password']){
                $login_ok = true;
            } 
        } 

        if($login_ok){ 
            unset($row['salt']); 
            unset($row['password']); 
            $_SESSION['user'] = $row;
            header("Location: landing.php"); 
            die("Redirecting to: landing.php");
        } 
        else{ 
            print("Login Failed."); 
            $submitted_email = htmlentities($_POST['inputEmail'], ENT_QUOTES, 'UTF-8'); 
        } 
    }
?>
<?php include('header.php'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="page-title">Welcome to the <span>Chicken2Me</span> Shops Portal</div>
        <div class="login-form-container">
            <div class="login-form-content">
                <div class="login-form-title text-center">Business Login</div>
                <form role="form" id="loginForm" class="login-form" action="index.php" method="post">
                    <div class="form-group">                  
                        <input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email" value="<?php echo $submitted_email; ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"><span class="remember-me">Remember me</span> 
                        </label>
                        <a class="pull-right" href="forgot-password.php">Forgot password?</a>
                    </div>
                    <input type="submit" class="login loginmodal-submit" value="Log In"/>
                    <div class="form-bottom-text-content text-center">
                        <a class="" href="signup.php">Want to sign up? Click here</a>
                    </div>                   
                </form>            
            </div>
        </div>    
        <div class="page-middle-border"></div>   
        <div class="page-title-orange">Why Sign Up...?</div>
        <div class="page-text">The Chicken2me portal allows businesses whose main product is chicken (whether it be fried, peri-peri or any other style) to take control of how their shop is displayed on the app so they can better advertise to tens of thousands of nearby customers, take deliveries from customers (more cheaply than other sites/apps) and make their businesses stand out from the rest. This portal allows you to make sure that your shop details are always up-to-date. It also allows you to manage your subscription fees and contact the dedicated chicken2me team to help you make your business the best it can be! Please log in using the form below. If you are not yet on chicken2me, click <a href="subscription-intro.php">HERE</a> to see what makes us stand out from the rest!</div>
    </div>
</div>
<?php include('footer.php');?>
