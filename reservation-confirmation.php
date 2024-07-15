<?php

// xdebug_break();

// Get the booking ID from the query variable
$booking_id = get_query_var('booking_id');
$redirect_url = get_query_var('redirect_url');
$should_redirect = get_query_var('should_redirect') == 'true'; // Assuming 'true' as a string

// Decode the URL if it's encoded
$redirect_url = urldecode($redirect_url);

// Retrieve booking information based on $booking_id
$booking_post = get_post($booking_id);

if (!$booking_post) {
    echo $booking_id;
    // Handle the case where no booking information is found
    echo 'No booking information found.';
    exit;
}

$move_in_date = get_post_meta($booking_id, 'move_in_date_string', true);
$customer_first_name = get_post_meta($booking_id, 'customer_first_name', true);
$customer_last_name = get_post_meta($booking_id, 'customer_last_name', true);
$customer_email_address = get_post_meta($booking_id, 'customer_email_address', true);
$customer_phone = get_post_meta($booking_id, 'customer_phone', true);
$department_name = get_post_meta($booking_id, 'department_name', true);
$department_address_street = get_post_meta($booking_id, 'department_address_street', true);
$department_address_city = get_post_meta($booking_id, 'department_address_city', true);
$department_address_zip =  get_post_meta($booking_id, 'department_address_zip', true);
$department_phone = get_post_meta($booking_id, 'department_phone', true);

$unit_link_id = get_post_meta($booking_id, 'unit_link', true);

$unit_price = get_post_meta($booking_id, 'unit_price', true);

//remove any trailing zeros from the unit price
$unit_price = get_post_meta($booking_id, 'unit_price', true);

// Remove trailing zeros
$unit_price = rtrim(rtrim($unit_price, '0'), '.');

$redirect_section = '
<div class="confirmation-section redirect-section">
      <div class="redirect-section-content">
            <h2 class="complete-booking-header">Færddigør din reservation</h2>
            <p class="redirect-message">
               Hvis du ikke er blevet omdirigeret til  ' . $department_name . ' - ' . $department_address_city  . ' - ' . $department_address_street  . ' - ' . $department_address_zip .  ',<span class="bold-redirect-message"> så klik på knappen nedenfor.</span>
            </p>

            <a href="' . $redirect_url . '" class="redirect-button" target="_blank">Færddiggør min reservation</a>
            <p class="reservation-sub-message">I mellemtiden har tjekdepot.dk midlertidigt reserveret enheden for dig, mens du færdiggør din lejeaftale.</p>
            <img alt="facility illustration" src="https://philes.sparefoot.com/assets/92ba77740c9af0e1cc3be40c408b4083576ff11b/images/hero/omi-illustration.svg" class="reservation-confirmation-illustration">
         </div>
</div>';

// Proceed with displaying the booking information
get_header();
?>

<style>
    body {
        background-color: #f7f7f7;
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
    }
</style>

<!--show redirect_section if $should_redirect is true. use the global $redirect_section-->
<?php if ($should_redirect) : ?>
    <?php echo $redirect_section; ?>
<?php endif; ?>

<div class="confirmation-section" style="padding-top: 40px;">
    <h1>Din reservation er bekræftet!</h1>
    <p class="confirmation-code-label"> Bekræftelseskode: </p>
    <p class="confirmation-code"><?php echo htmlspecialchars($booking_id); ?></p>
    <p class="move-in-date-label">Din indflytningsdato</p>
    <p class="move-in-date"><?php echo htmlspecialchars($move_in_date); ?></p>
    <!-- <p class="office-hours">Udbyderens åbningstider: 9:30 - 6:00</p> -->
</div>



<div class="confirmation-section">
    <h2>Hvad sker der nu?</h2>
    <p class="what-now-text"><span class="checkmark">&#10003;</span> Tjek din email-indbakke for en bekræftelses-mail med alle dine detaljer.</p>

    <p class="what-now-text"><span class="checkmark">&#10003;</span> Vi opfordrer dig og udbyderen til at kontakte hinanden på forhånd. Hvis du ikke allerede har talt med dem, så ring til dem.</p>

    <!-- Repeat for other user information details -->
</div>



<div class="confirmation-section">
    <h3>Din information</h3>
    <!-- Display user information -->
    <p class="small-text"><?php echo htmlspecialchars($customer_first_name . " " . $customer_last_name); ?></p>
    <p class="small-text"><?php echo htmlspecialchars($customer_email_address); ?></p>
    <p class="small-text"><?php echo htmlspecialchars($customer_phone); ?></p>
    <h3 style="margin-top: 1rem;">Din udbyder</h3>
    <p><?php echo htmlspecialchars($department_name); ?></p>
    <p><?php echo htmlspecialchars($department_address_street); ?></p>
    <p><?php echo htmlspecialchars($department_address_city); ?></p>
    <p><?php echo htmlspecialchars($department_address_zip); ?></p>
    <p><?php echo htmlspecialchars($department_phone); ?></p>
    <!-- Repeat for other user information details -->
</div>

<div class="confirmation-section" style="padding: 20px 0px 20px 40px !important;">
    <h3>Din opbevaringsenhed</h3>
    <div class="price-section">
        <div class="sub-price-section">
            <p class="price-label">Pris</p>
        </div>
        <div class="sub-price-section" style="padding-left: 1rem; padding-right: 2rem;">
            <p class="price"><?php echo htmlspecialchars($unit_price); ?> kr</p>
            <p class="price-sub-label">om måneden</p>
        </div>
    </div>

</div>

<?php
if ($should_redirect && !empty($redirect_url)) {
    echo "<meta http-equiv='refresh' content='10;url=$redirect_url'>";
    // Log to browser console
    echo "<script>console.log('Redirecting in 10 seconds to: " . addslashes($redirect_url) . "');</script>";
} else {
    // Log debug information if the redirect is not happening
    echo "<script>console.log('Redirect condition not met. should_redirect: " . ($should_redirect ? 'true' : 'false') . ", redirect_url: " . addslashes($redirect_url) . "');</script>";
}
?>

<?php
get_footer();

?>