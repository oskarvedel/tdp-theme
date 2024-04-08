<?php

// xdebug_break();

// Get the booking ID from the query variable
$booking_id = get_query_var('booking_id');
// xdebug_break();

// Retrieve booking information based on $booking_id
$booking_post = get_post($booking_id);

if (!$booking_post) {
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
$department_address = get_post_meta($booking_id, 'department_address', true);
$department_phone = get_post_meta($booking_id, 'department_phone', true);

$unit_link_id = get_post_meta($booking_id, 'unit_link', true);

$unit_price = get_post_meta($booking_id, 'unit_price', true);

//remove any trailing zeros from the unit price
$unit_price = get_post_meta($booking_id, 'unit_price', true);

// Remove trailing zeros
$unit_price = rtrim(rtrim($unit_price, '0'), '.');

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

<div class="confirmation-section" style="padding-top: 40px;">
    <h1>Din reservation er bekræftet!</h1>
    <p class="confirmation-code-label"> Bekræftelseskode: </p>
    <p class="confirmation-code"><?php echo htmlspecialchars($booking_id); ?></p>
    <p class="move-in-date-label">Din indflytningsdato</p>
    <p class="move-in-date"><?php echo htmlspecialchars($move_in_date); ?></p>
    <p class="office-hours">Udbyderens åbningstider: 9:30 - 6:00</p>
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
    <p><?php echo htmlspecialchars($department_address); ?></p>
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
get_footer();
?>