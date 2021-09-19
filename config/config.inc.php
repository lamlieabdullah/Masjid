<?php
if(!defined('LIVE')) DEFINE('LIVE', true);
define('CONTACT_EMAIL', 'lamlie@gmail.com');  //pinda dengan mengisi dengan maklumat yang sesuai
define ('BASE_URL', 'localhost/masjid'); //pinda dengan mengisi dengan maklumat yang sesuai
define ('BASE_URI', 'C:/xampp/htdocs'); //pinda dengan mengisi dengan maklumat yang sesuai

/*=============== jangan pinda di bawah bahagian ini sekiranya anda tidak tahu apa yang anda lakukan=========================*/
define ('MYSQL', BASE_URI . '/config/sql.inc.php'); 

define ('database_prefix', 'masjid');

date_default_timezone_set("Asia/Kuala_Lumpur");

 // checking $protocol in HTTP or HTTPS
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
            // this is HTTPS
            $protocol  = "https";
        } else {
            // this is HTTP
            $protocol  = "http";
        }
$home_url = $protocol .'://'. BASE_URL;

// ********************************* //
// ************ SESSIONS *********** //

// Start the session:
session_start();

// ************ SESSIONS *********** //
// ********************************* //

// ****************************************** //
// ************ ERROR MANAGEMENT ************ //

// Function for handling errors.
// Takes five arguments: error number, error message (string), name of the file where the error occurred (string)
// line number where the error occurred, and the variables that existed at the time (array).
// Returns true.
function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars) {

	// Build the error message:
	$message = "An error occurred in script '$e_file' on line $e_line:\n$e_message\n";

	// Add the backtrace:
	$message .= "<pre>" .print_r(debug_backtrace(), 1) . "</pre>\n";

	// Or just append $e_vars to the message:
	//	$message .= "<pre>" . print_r ($e_vars, 1) . "</pre>\n";

	if (!LIVE) { // Show the error in the browser.

		echo '<div class="alert alert-danger">' . nl2br($message) . '</div>';

	} else { // Development (print the error).

		// Send the error in an email:
		error_log ($message, 1, CONTACT_EMAIL, 'From:admin@denshie.com');

		// Only print an error message in the browser, if the error isn't a notice:
		if ($e_number != E_NOTICE) {
			echo '<div class="alert alert-danger">A system error occurred. We apologize for the inconvenience.</div>';
		}

	} // End of $live IF-ELSE.

	return true; // So that PHP doesn't try to handle the error, too.

} // End of my_error_handler() definition.

// Use my error handler:
set_error_handler('my_error_handler');

// ************ ERROR MANAGEMENT ************ //
// ****************************************** //

// ******************************************* //
// ************ REDIRECT FUNCTION ************ //

// This function redirects invalid users.
// It takes two arguments:
// - The session element to check
// - The destination to where the user will be redirected.
function redirect_invalid_user($check = 'user_id', $destination = 'index.php', $protocol = 'http://') {

	// Check for the session item:
	if (!isset($_SESSION[$check])) {
		$url = $protocol . BASE_URL . $destination; // Define the URL.
		header("Location: $url");
		exit(); // Quit the script.
	}

} // End of redirect_invalid_user() function.

// ************ REDIRECT FUNCTION ************ //
// ******************************************* //

// Omit the closing PHP tag to avoid 'headers already sent' errors!
