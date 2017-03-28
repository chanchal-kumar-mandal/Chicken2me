<?php require("assets/config.php"); ?>
<?php include('header.php'); ?>
<?php if(isset($_SESSION['user'])): ?>
<div class="row">
    <div class="col-md-2 pull-right logout-container">Welcome <?php echo $_SESSION['user']['name']; ?> <a href="logout.php" class="btn btn-sm btn-danger">Logout</a></div>
</div>
<?php endif; ?>
<div class="row">
    <div class="col-md-12">
        <div class="page-title">Welcome to the <a href="landing.php">Chicken2Me</a> Shops Portal</div>
        <div class="signup-page-top-text">
        <div class="signup-top-title text-center">WHY BE A PART OF CHICKEN2ME?</div>​
        Chicken2me is the first dedicated chicken shop app. We’re different from other non-specific food service apps and websites. We understand the chicken shop industry, whether fried, peri-peri or any other delicious style. The chicken2me team grew up in East London around chicken shops and understand their place within culture, their place as the people’s food. The benefits of being on the app are numerous but in short, we allow your shop to be advertised to tens of thousands of people in your area, and many more further afield. We allow for users to get food delivered from your shop as well. Because we know how hard you work for what you have, we offer a simple monthly fee instead of other apps and websites who take a cut of each order. By being a part of chicken2me, you can be sure of a service dedicated to your specific needs and to hopefully make your business more successful than ever. To show how much we understand the importance of the chicken shop to our city, your first month on the app is absolutely free. After that we offer pricing plans starting from as low as £30 a month. You can find a link below to contact us and we will help to answer any questions that you may have. We hope to hear from you soon.
        </div>
    </div>
    <div class="col-md-12">
        <div class="signup-links-container">
            <div class="signup-link-content">
                <div class="signup-link-top-left">Standard - £30/month</div>
                <div class="signup-link-bottom">
                    Standard subscribers have the following key benefits of a partnership with Chicken2me:<br/><br/>
                    <ul>
                        <li>Your shop will be featured on the app with it's own distinct flame, allowing thousands of people nearby who may never have heard of your shop to become physical customers.</li>
        ​
                        <li>You will also be able to take deliveries from customers.​</li>
                    </ul><br/><br/>
                    <div class="box effect1">
                        <h3>
                            <a href="#">Sign up to Standard</a>
                        </h3>
                    </div>
                </div>
            </div>    
            <div class="signup-link-content">
                <div class="signup-link-top-center">Premium - £75/month</div>
                <div class="signup-link-bottom signup-link-bottom-middle">
                    Premium subscribers have all the benefits of those on Standard plus:<br/><br/>
                    <ul>
                        <li>Your shop will come up higher than others when a user searches for shops in their area.</li>
        ​
                        <li>Allows for users to favourite your shop so that they can access it quicker.</li>
        ​
                        <li>Allows users to vote for your shop to be visited by the Chicken Connoisseur.</li>
                    </ul><br/>
                    <div class="box effect1">
                        <h3>
                            <a href="signup.php">Sign up to Premium</a>
                        </h3>
                    </div>
                </div>
            </div>    
            <div class="signup-link-content">
                <div class="signup-link-top-right">Ultimate - Contact Us</div>
                <div class="signup-link-bottom">
                    For tailor-made sponsorship opportunities send an email to: <a href="mailto:contact@chicken2me">contact@chicken2me</a><br/><br/>
                    <div class="box effect1">
                        <h3>
                            <a href="signup.php">Contact Us</a>
                        </h3>
                    </div>
                </div>
            </div>     
            <div class="signup-bottom text-center">
                On ANY plan, save 10% when you pay for 6 months in advance + gain additional bonuses for your business!<br>
                <span>BE KNOWN, BE WITH Chicken2me</span>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php');?>
