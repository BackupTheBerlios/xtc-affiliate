<?php
/*------------------------------------------------------------------------------
   $Id: affiliate_affiliate.php,v 1.1 2003/12/21 20:13:07 hubi74 Exp $

   XTC-Affiliate - Contribution for XT-Commerce http://www.xt-commerce.com
   modified by http://www.netz-designer.de

   Copyright (c) 2003 netz-designer
   -----------------------------------------------------------------------------
   based on:
   (c) 2003 OSC-Affiliate (affiliate_affiliate.php, v 1.8 2003/02/19);
   http://oscaffiliate.sourceforge.net/

   Contribution based on:

   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 - 2003 osCommerce

   Released under the GNU General Public License
   ---------------------------------------------------------------------------*/

require('includes/application_top.php');

// create smarty elements
$smarty = new Smarty;

// include boxes
require(DIR_WS_INCLUDES.'boxes.php');

// include needed functions
require_once(DIR_FS_INC . 'xtc_draw_password_field.inc.php');
require_once(DIR_FS_INC . 'xtc_image_button.inc.php');
require_once(DIR_FS_INC . 'xtc_validate_password.inc.php');

if (isset($_SESSION['affiliate_id'])) {
    xtc_redirect(xtc_href_link(FILENAME_AFFILIATE_SUMMARY, '', 'SSL'));
}

if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
    $affiliate_username = xtc_db_prepare_input($_POST['affiliate_username']);
    $affiliate_password = xtc_db_prepare_input($_POST['affiliate_password']);
    
    // Check if username exists
    $check_affiliate_query = xtc_db_query("select affiliate_id, affiliate_firstname, affiliate_password, affiliate_email_address from " . TABLE_AFFILIATE . " where affiliate_email_address = '" . xtc_db_input($affiliate_username) . "'");
    if (!xtc_db_num_rows($check_affiliate_query)) {
        $_GET['login'] = 'fail';
    }
    else {
        $check_affiliate = xtc_db_fetch_array($check_affiliate_query);
        // Check that password is good
        if (!xtc_validate_password($affiliate_password, $check_affiliate['affiliate_password'])) {
            $_GET['login'] = 'fail';
        }
        else {
            $_SESSION['affiliate_id'] = $check_affiliate['affiliate_id'];

            $date_now = date('Ymd');
            
            xtc_db_query("update " . TABLE_AFFILIATE . " set affiliate_date_of_last_logon = now(), affiliate_number_of_logons = affiliate_number_of_logons + 1 where affiliate_id = '" . $_SESSION['affiliate_id'] . "'");
            xtc_redirect(xtc_href_link(FILENAME_AFFILIATE_SUMMARY,'','SSL'));
        }
    }
}

$breadcrumb->add(NAVBAR_TITLE, xtc_href_link(FILENAME_AFFILIATE, '', 'SSL'));

require(DIR_WS_INCLUDES . 'header.php');

if (isset($_GET['login']) && ($_GET['login'] == 'fail')) {
    $info_message = 'true';
}
else {
    $info_message = 'false';
}

$smarty->assign('info_message', $info_message);

$smarty->assign('FORM_ACTION', xtc_draw_form('login', xtc_href_link(FILENAME_AFFILIATE, 'action=process', 'SSL')));
$smarty->assign('LINK_TERMS', '<a  href="' . xtc_href_link(FILENAME_CONTENT,'coID=900', 'SSL') . '">');
$smarty->assign('INPUT_AFFILIATE_USERNAME', xtc_draw_input_field('affiliate_username'));
$smarty->assign('INPUT_AFFILIATE_PASSWORD', xtc_draw_password_field('affiliate_password'));
$smarty->assign('LINK_PASSWORD_FORGOTTEN', '<a href="' . xtc_href_link(FILENAME_AFFILIATE_PASSWORD_FORGOTTEN, '', 'SSL') . '">');
$smarty->assign('LINK_SIGNUP', '<a href="' . xtc_href_link(FILENAME_AFFILIATE_SIGNUP, '', 'SSL') . '">' . xtc_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>');
$smarty->assign('BUTTON_LOGIN', xtc_image_submit('button_login.gif', IMAGE_BUTTON_LOGIN));

$smarty->assign('language', $_SESSION['language']);
$smarty->caching = 0;
$main_content=$smarty->fetch(CURRENT_TEMPLATE . '/module/affiliate_affiliate.html');
$smarty->assign('main_content',$main_content);

$smarty->assign('language', $_SESSION['language']);
$smarty->caching = 0;
$smarty->display(CURRENT_TEMPLATE . '/index.html');?>
