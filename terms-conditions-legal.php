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
        <div class="terms-conditions-legal-container">
        TERMS & CONDITIONS<br/>
        Chicken2Me (the “App”) is operated by Nuwave Ltd (“Nuwave”), a company registered in the United Kingdom under company number 10412632. Use of the app will constitute acceptance of these Terms and Conditions. Please read these Terms and Conditions carefully and print a copy for your records. For any queries regarding use of this app or these Terms and Conditions, please contact: contact@chicken2me.com.
        The App enables Chicken2Me partner-businesses, who are independent food businesses using the Chicken2Me app across the world, as well as new businesses not yet on the Chicken2Me platform but that intend to join the Chicken2Me platform (“food businesses”) to be eligible to receive certain products, services and/or discounts provided by third parties when using the App as set on this Chicken2Me website, being: <a href="http://www.chicken2me.com" target="_blank" data-content="http://www.chicken2me.com" data-type="external">www.chicken2me.com</a>
        The App enables businesses partnered with Chicken2me to receive certain products, services and/or discounts.
        Neither use of the App nor anything on this website shall be deemed to establish any employee/employer relationship between any of the following parties: Chicken2Me, the food business or app user.
        The information on these pages may be updated from time to time and may at times be out of date. Nuwave does not accept responsibility for keeping the information in these pages up to date or liability for any failure to do so.
        The food business is solely responsible for all interactions with third parties. Paying for subscription fees does in no way guarantee a definite increase in customers, as this is subject to multiple factors outside the control of nuwave. 
        Products, services and/or discounts displayed on this website are for information purposes only and do not constitute advice. To the maximum extent permitted by law, Nuwave expressly excludes all representations, warranties, obligations and liabilities in connection with this website or other third party websites and the information provided therein nor for the products and/or services referred to therein.
        Products, services and/or discounts offered in connection with the App are subject to change at any time and without notice. Nuwave does not guarantee that any products, services and/or discounts displayed on www.NuwaveApp.co.uk are available or valid at any particular time and under no circumstances shall Nuwave be liable for the failure of any third party product, service and/or discount as displayed on this website being applied. Availability and validity is at the discretion of the third party offering the product, service and/or discount and subject to any terms referenced by such third party. Nuwave reserves in all cases the right to remove or vary the products, services and/or discounts. Links to third party websites are not the responsibility of Nuwave and Nuwave accepts no responsibility for the availability, suitability, reliability or content of such third party websites and does not endorse or accept any responsibility for the use of the products, services and/or discounts stated within such third party websites.
        The food business understands that Nuwave may receive anonymised data regarding their business through consumers’ use of the App.
        These Terms and Conditions are governed by the law of the United Kingdon.
        </div>
    </div>
</div>
<?php include('footer.php');?>
