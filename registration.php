<?php require("assets/config.php"); ?>
<?php include('header.php'); ?>
<?php
if(!empty($_POST)) {
    // Ensure that the user fills out fields 
    if(empty($_POST['inputName'])) 
    { die("Please enter a Name."); } 
    if(empty($_POST['inputPassword'])) 
    { die("Please enter a password."); } 
    if(!filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL)) 
    { die("Empty or Invalid E-Mail Address"); } 
    if(empty($_POST['inputShopId'])) 
    { die("Please enter Shop IDs"); }

    // Check if the username is already taken
    $query = "SELECT 1 FROM shop_user WHERE useremail = :useremail"; 
    $query_params = array( ':useremail' => $_POST['inputEmail'] ); 
    try { 
        $stmt = $db->prepare($query); 
        $result = $stmt->execute($query_params); 
    } 
    catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
    $row = $stmt->fetch(); 
    if($row){ die("<h2>This email address is already registered</h2>"); }

    // Add row to database 
    $query = "INSERT INTO shop_user (name, useremail, password, salt) VALUES (:name, :useremail, :password, :salt)"; 
     
    // Security measures
    $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
    $password = hash('sha256', $_POST['inputPassword'] . $salt); 
    for($round = 0; $round < 65536; $round++){ $password = hash('sha256', $password . $salt); } 
    $query_params = array( 
        ':name' => $_POST['inputName'], 
        ':useremail' => $_POST['inputEmail'], 
        ':password' => $password, 
        ':salt' => $salt
    ); 
    try {  
        $stmt = $db->prepare($query); 
        $result = $stmt->execute($query_params); 
    } 
    catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
    
    if($result) {
        // Last Inserted user id
        $userid = $db->lastInsertId();
        $shopIdsString = $_POST['inputShopId'];

        // Update shop table
        $query = "UPDATE shop SET
               userid = :userid
               WHERE shopid IN ($shopIdsString)";
        $query_params = array(':userid' => $userid); 
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }

        echo "<h3>User Registered Successfully.</h3>";
    }

}

?>
<div class="col-md-12">
    <div class="page-title">Welcome to the <span>Chicken2Me</span> Shops Portal</div>
    <div class="login-form-container">
        <div class="login-form-content">
            <div class="login-form-title text-center">Business Registration</div>
            <form role="form" id="loginForm" class="login-form" action="registration.php" method="post">
                <div class="form-group">                  
                    <input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="inputShopId">Enter Comma separated Shop Ids e.g. 3,7,21,32</label>                
                    <input type="text" class="form-control" id="inputShopId" name="inputShopId" placeholder="Shop IDs">
                </div>
                <input type="submit" class="login loginmodal-submit" value="Register"/>
                <div class="form-bottom-text-content text-center">
                    <a class="" href="index.php">Want to log in? Click here</a>
                </div>                   
            </form>            
        </div>
    </div> 
</div>
<?php include('footer.php');?>
