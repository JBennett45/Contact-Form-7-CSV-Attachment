<?php
// Add this to functions.php //
// Create CSV by scraping email using before_send_mail action //
add_action( 'wpcf7_before_send_mail', 'cf7_csv_creation' );
function cf7_csv_creation($cf7) {
  // Allow to target the ID of specific form  //
  $form_id = $cf7->id();
  // Check certain form by ID - remove this IF statement if not specific //
  if ($form_id == 'your_form_ID'){
    // Make sure the file is saved into wp-content to retieve it within WPCF7 settings as an attachement //
    $user_register_csv = 'wp-content/uploads/csvs/your_csv_file.csv';
    // Create file contents - if you have more fields add them to the output below //
    $output = "";
    $output .= "Name: " . $_POST['your-name'];
    $output .= "Email: " . $_POST['your-email'];
    // Save contents to file //
    file_put_contents($user_register_csv, $output);
  }
}
// Clear file/user data after submission //
add_action('wpcf7_mail_sent', function ($cf7) {
  $user_register_csv = 'wp-content/uploads/csvs/your_csv_file.csv';
  file_put_contents($user_register_csv, '');
  // File cleared and ready to be rewritten on next submission //
});
// Remember - add the above path to the WPCF7 File attachment setting within the relevant form //
?>
