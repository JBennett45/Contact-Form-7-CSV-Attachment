<?php
// This goes in functions.php //

// Form CSV creations//
add_action( 'wpcf7_before_send_mail', 'cf7_csv_creation' );
function cf7_csv_creation($cf7) {
  // setup form ID //
  $form_id = $cf7->id();
  // check over certain forms 9if generic remove the if statement //
  if ($form_id == 'your_form_ID'){
    // Put your CSV folder within wp-content *make sure its saved to wp-content so you can call it within WPCF7 settings*//
    $user_register_csv = 'wp-content/uploads/csvs/your_csv_file.csv';
    // create contents - if you have more fields just change the field names below //
    $output = "";
    $output .= "Name: " . $_POST['your-name'];
    $output .= "Email: " . $_POST['your-email'];
    // write to file //
    file_put_contents($user_register_csv, $output);
  }
}

// Clear user data after submission & attachment //
add_action('wpcf7_mail_sent', function ($cf7) {
  $user_register_csv = 'wp-content/uploads/csvs/your_csv_file.csv';
  file_put_contents($user_register_csv, '');
});

// *Remember* - in WPCF7 File attachment settings you need to add the above path //
?>
