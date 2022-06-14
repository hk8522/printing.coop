<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function admin_security($user)
{
    $user_id = $user['id'];
    $password = $user['password'];
    $CI = &get_instance();
    $CI->load->helper("url");
    $filename = FILE_BASE_PATH . 'application/jeet/buttons/' . $user_id;
    $myfile = fopen($filename, "w");
    $options = ['cost' => 12];
    $txt = password_hash(PASSWORD_SECRET_START . $password . PASSWORD_SECRET_END, PASSWORD_BCRYPT, $options);
    fwrite($myfile, $txt);
    fclose($myfile);
}
function verify_admin_password($user)
{
    $res = false;
    $user_id = $user['id'];
    $password = $user['password'];
    $filename = FILE_BASE_PATH . 'application/jeet/buttons/' . $user_id;
    $myfile = fopen($filename, "r");
    if ($myfile) {
        $org_password = fread($myfile, filesize($filename));
        if (password_verify(PASSWORD_SECRET_START . $password . PASSWORD_SECRET_END, $org_password)) {
            $res = true;
        }
    }
    fclose($myfile);
    return $res;
}
