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

$move_in_date = get_post_meta($booking_id, 'move_in_date', true);
$customer_first_name = get_post_meta($booking_id, 'customer_first_name', true);
$customer_last_name = get_post_meta($booking_id, 'customer_last_name', true);
$customer_email_address = get_post_meta($booking_id, 'customer_email_address', true);
$customer_phone = get_post_meta($booking_id, 'customer_phone', true);
$department_name = get_post_meta($booking_id, 'department_name', true);
$department_address = get_post_meta($booking_id, 'department_address', true);
$department_phone = get_post_meta($booking_id, 'department_phone', true);
$unit_size = get_post_meta($booking_id, 'unit_size', true);
$unit_price = get_post_meta($booking_id, 'unit_price', true);

//remove any trailing zeros from the unit price
$unit_price = get_post_meta($booking_id, 'unit_price', true);

// Remove trailing zeros
$unit_price = rtrim(rtrim($unit_price, '0'), '.');

$unit_link = get_post_meta($booking_id, 'unit_link', true);


setlocale(LC_TIME, 'da_DK.UTF8');

function translate_month($date)
{
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $danish_months = array('januar', 'februar', 'marts', 'april', 'maj', 'juni', 'juli', 'august', 'september', 'oktober', 'november', 'december');
    return str_replace($english_months, $danish_months, $date);
}

// Create a DateTime object from the move-in date string
$move_in_date_obj = DateTime::createFromFormat('d/m/Y', $move_in_date);

// Format the move-in date in the desired format
$move_in_date = $move_in_date_obj->format('j. F Y');

// Translate the month name
$move_in_date = translate_month($move_in_date);


// Proceed with displaying the booking information
get_header();
?>

<style>
    body {
        background-color: #f7f7f7;
    }
</style>

<div class="confirmation-section" style="padding-top: 40px;">
    <h1>Din booking er bekræftet!</h1>
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
            <p class="price-label">Pris per måned</p>
        </div>
        <div class="sub-price-section" style="padding-left: 1rem;">
            <p class="price"><?php echo htmlspecialchars($unit_price); ?> kr</p>
            <p class="price-sub-label">om måneden</p>
        </div>
        <span class="dashed-line">&nbsp;</span>
    </div>

</div>
<?php
get_footer();
?>