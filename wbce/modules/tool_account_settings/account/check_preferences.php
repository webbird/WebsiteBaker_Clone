<?php
/**
 * WebsiteBaker Community Edition (WBCE)
 * Way Better Content Editing.
 * Visit http://wbce.org to learn more and to join the community.
 *
 * @copyright Ryan Djurovich (2004-2009)
 * @copyright WebsiteBaker Org. e.V. (2009-2015)
 * @copyright WBCE Project (since 2015)
 * @license GNU GPL2 (or any later version)
 */

// Must include code to stop this file being access directly
defined('WB_PATH') or die("Cannot access this file directly"); 

// Check FTAN
if (!$wb->checkFTAN()) {
    $wb->print_error($MESSAGE['GENERIC_SECURITY_ACCESS'], WB_URL);
}

$success = array();
$error   = array();

$sCurrPassword = $wb->get_post('current_password');
$sEncPassword  = $wb->checkPasswordPattern($sCurrPassword);
$sNewEmail     = $wb->get_post('email');

// validate confirmation password
$sSql  = "SELECT `user_id` FROM `{TP}users` WHERE `user_id` = %d AND `password` = '%s'";
if(is_array($sEncPassword)){
    $error[] = $MESSAGE['PREFERENCES_CURRENT_PASSWORD_INCORRECT'];
} elseif($database->get_one(sprintf($sSql, $wb->get_user_id(), $sEncPassword)) == false) {
    $error[] = $MESSAGE['PREFERENCES_CURRENT_PASSWORD_INCORRECT'];
} else { 

    // Get entered values
    $sDisplayName  = $wb->add_slashes(strip_tags($wb->get_post('display_name')));
    $sLC           = $wb->get_post('language');
    $sLanguage     = preg_match('/^[A-Z]{2}$/', $sLC) ? $sLC : 'EN';
    $sTimezone     = is_numeric($wb->get_post('timezone')) ? $wb->get_post('timezone')*60*60 : 0;
    $sDateFormat   = $wb->get_post('date_format');
    $sTimeFormat   = $wb->get_post('time_format');

    // Update user data
    $aUpdate = array(
        'user_id'      => $wb->get_user_id(),
        'display_name' => $database->escapeString($sDisplayName),
        'language'     => $database->escapeString($sLanguage),
        'timezone'     => $database->escapeString($sTimezone),
        'date_format'  => $database->escapeString($sDateFormat),
        'time_format'  => $database->escapeString($sTimeFormat),
    );

    // Validate email format
    if(!$wb->validate_email($sNewEmail)) {
        $error[] = $MESSAGE['USERS_INVALID_EMAIL'];
    } else {
        $aUpdate['email']   = $database->escapeString($sNewEmail);
    }

    // Validate new password if entered
    if($wb->get_post('new_password') != ''){
        
        $sNewPassword      = $wb->get_post('new_password');
        $sRePassword       = $wb->get_post('new_password2');
    
        $checkPassword =  $wb->checkPasswordPattern($sNewPassword, $sRePassword);
        if (is_array($checkPassword)){
            $error[] = $checkPassword[0];
        } else {
            // Add password to Update array
            $aUpdate['password'] = $checkPassword;
        }            
    }

    // Update Data in Database
    if(empty($error) && $database->updateRow('{TP}users', 'user_id', $aUpdate)) {
        $success[] = $MESSAGE['PREFERENCES_DETAILS_SAVED'];
        if(isset($aUpdate['password']))
            $success[] = $MESSAGE['PREFERENCES_PASSWORD_CHANGED'];

        // update SESSION values
        $_SESSION['DISPLAY_NAME'] = $sDisplayName;
        $_SESSION['TIMEZONE']     = $sTimezone;
        $_SESSION['LANGUAGE']     = $sLanguage; 
        $_SESSION['HTTP_REFERER'] = ($_SESSION['LANGUAGE'] == LANGUAGE) ? $_SESSION['HTTP_REFERER'] : WB_URL;
        
        // Update DATE_FORMAT 
        if($sDateFormat != '') {
            $_SESSION['DATE_FORMAT'] = $sDateFormat;
            if(isset($_SESSION['USE_DEFAULT_DATE_FORMAT'])) unset($_SESSION['USE_DEFAULT_DATE_FORMAT']); 
        } else {
            $_SESSION['USE_DEFAULT_DATE_FORMAT'] = true;
            if(isset($_SESSION['DATE_FORMAT']))             unset($_SESSION['DATE_FORMAT']); 
        }

        // Update TIME_FORMAT 
        if($sTimeFormat != '') {
            $_SESSION['TIME_FORMAT'] = $sTimeFormat;
            if(isset($_SESSION['USE_DEFAULT_TIME_FORMAT'])) unset($_SESSION['USE_DEFAULT_TIME_FORMAT']); 
        } else {
            $_SESSION['USE_DEFAULT_TIME_FORMAT'] = true;
            if(isset($_SESSION['TIME_FORMAT']))             unset($_SESSION['TIME_FORMAT']); 
        }
    } else {
        $error[] = $database->get_error();
    }
}

