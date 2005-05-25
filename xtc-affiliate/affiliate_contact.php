<?php
/*------------------------------------------------------------------------------
   $Id: affiliate_contact.php,v 1.3 2005/05/25 18:20:23 hubi74 Exp $

   XTC-Affiliate - Contribution for XT-Commerce http://www.xt-commerce.com
   modified by http://www.netz-designer.de

   Copyright (c) 2003 netz-designer
   -----------------------------------------------------------------------------
   based on:
   (c) 2003 OSC-Affiliate (affiliate_contact.php, v 1.3 2003/02/15);
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

// include needed functions
require_once(DIR_FS_INC . 'xtc_draw_input_field.inc.php');
require_once(DIR_FS_INC . 'xtc_draw_textarea_field.inc.php');
require_once(DIR_FS_INC . 'xtc_validate_email.inc.php');
require_once(DIR_FS_INC . 'xtc_image_button.inc.php');

// include boxes
require(DIR_FS_CATALOG .'templates/'.CURRENT_TEMPLATE. '/source/boxes.php');

// include the mailer-class
require_once(DIR_WS_CLASSES . 'class.phpmailer.php');

// include all for the mails
require_once(DIR_WS_CLASSES.'class.phpmailer.php');
require_once(DIR_FS_INC . 'xtc_php_mail.inc.php');

if (!isset($_SESSION['affiliate_id'])) {
    xtc_redirect(xtc_href_link(FILENAME_AFFILIATE, '', 'SSL'));
}

$error = false;
if (isset($_GET['action']) && ($_GET['action'] == 'send')) {
    if (xtc_validate_email(trim($_POST['email']))) {
        xtc_php_mail($_POST['email'], $_POST['name'], AFFILIATE_EMAIL_ADDRESS, STORE_OWNER, '', $_POST['email'], $_POST['name'], '', '', EMAIL_SUBJECT, $_POST['enquiry'], $_POST['enquiry']);
        if (!isset($mail_error)) {
            xtc_redirect(xtc_href_link(FILENAME_AFFILIATE_CONTACT, 'action=success'));
        }
        else {
            echo $mail_error;
        }
    }
    else {
        $error = true;
    }
}

$breadcrumb->add(NAVBAR_TITLE, xtc_href_link(FILENAME_AFFILIATE, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_CONTACT, xtc_href_link(FILENAME_AFFILIATE_CONTACT));

require(DIR_WS_INCLUDES . 'header.php');

if (isset($_GET['action']) && ($_GET['action'] == 'success')) {
    $smarty->assign('SUMMARY_LINK', '<a href="' . xtc_href_link(FILENAME_AFFILIATE_SUMMARY) . '">' . xtc_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>');
}
else {
	// Get some values of the Affiliate
	$affili_sql = xtc_db_query("SELECT affiliate_firstname, affiliate_lastname, affiliate_email_address FROM " . TABLE_AFFILIATE . " WHERE affiliate_id = " . $_SESSION['affiliate_id']);
	$affili_res = xtc_db_fetch_array($affili_sql);
	
    $smarty->assign('FORM_ACTION', xtc_draw_form('contact_us', xtc_href_link(FILENAME_AFFILIATE_CONTACT, 'action=send')));
    $smarty->assign('INPUT_NAME', xtc_draw_input_field('name', $affili_res['affiliate_firstname'] . ' ' . $affili_res['affiliate_lastname'], 'size=40'));
    $smarty->assign('INPUT_EMAIL', xtc_draw_input_field('email', $affili_res['affiliate_email_address'], 'size=40'));
    $smarty->assign('error', $error);
    $smarty->assign('TEXTAREA_ENQUIRY', xtc_draw_textarea_field('enquiry', 'soft', 50, 15, $_POST['enquiry']));
    $smarty->assign('BUTTON_SUBMIT', xtc_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE));
}
$smarty->assign('language', $_SESSION['language']);
$smarty->caching = 0;
$main_content=$smarty->fetch(CURRENT_TEMPLATE . '/module/affiliate_contact.html');
$smarty->assign('main_content',$main_content);

$smarty->assign('language', $_SESSION['language']);
$smarty->caching = 0;
$smarty->display(CURRENT_TEMPLATE . '/index.html');?>
