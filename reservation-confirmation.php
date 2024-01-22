<?php
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


// Proceed with displaying the booking information
get_header();
?>

<div class="reservation-confirmation">
    <div class="confirmation-header">
        <h1>Din booking er bekræftet!</h1>
        <p>Bekræftelseskode: <?php echo htmlspecialchars($booking_id); ?></p>
    </div>

    <div class="reservation-details">
        <h2>Move-in Date</h2>
        <p><?php echo htmlspecialchars($move_in_date); ?></p>
        <!-- Repeat for other booking details -->
    </div>

    <div class="your-information">
        <h2>Din information</h2>
        <!-- Display user information -->
        <p>Navn: <?php echo htmlspecialchars($customer_first_name . " " . $customer_last_name); ?></p>
        <p>Email: <?php echo htmlspecialchars($customer_email_address); ?></p>
        <!-- Repeat for other user information details -->
    </div>

    <div class="storage-facility">
        <h2>Din udbyder</h2>
        <!-- Display storage facility information -->
        <p>Adresse: <?php echo htmlspecialchars($department_address); ?></p>
        <p>Telefon: <?php echo htmlspecialchars($department_phone); ?></p>
    </div>

    <div class="storage-unit">
        <h2>Dit enhed</h2>
        <!-- Display storage unit details -->
        <p>Størrelse: <?php echo htmlspecialchars($unit_size); ?></p>
        <p>Månedlig: <?php echo htmlspecialchars($unit_price); ?></p>
    </div>
</div>

<?php
get_footer();
?>