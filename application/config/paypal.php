<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/** set your paypal credential **/

/*$config['client_id'] ='AZD3q3uT7otKvvckfiGhBc-6WPpNs4XOXbiJgqgvLzW5ZttbQI4-1_OYy3LFanlKlP6sC0TNdx8DtnIT';
$config['secret'] = 'EMr4VN0J2lU8hGA3k9N-FWchi5rXWjdmaQR6Pc_PMduwFzrw4bGdvQ-fN351Jk-kFQXWRJZ-C1wI3DVd';
$config['business'] = 'vishusand123-facilitator@gmail.com';*/

$config['client_id'] = '';
$config['secret'] = '';
$config['business'] = '';
// ------------------------------------------------------------------------
// Paypal library configuration
// ------------------------------------------------------------------------

// Use PayPal on Sandbox or Live
$config['sandbox'] = true; // FALSE for live environment

// PayPal Business Email

// If (and where) to log ipn to file
$config['paypal_lib_ipn_log_file'] = BASEPATH . 'logs/paypal_ipn.log';
$config['paypal_lib_ipn_log'] = true;

// Where are the buttons located at
$config['paypal_lib_button_path'] = 'buttons';

// What is the default currency?
$config['paypal_lib_currency_code'] = 'USD';
