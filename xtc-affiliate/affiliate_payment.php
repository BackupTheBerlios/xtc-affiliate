<?php
/*------------------------------------------------------------------------------
   $Id: affiliate_payment.php,v 1.1 2003/12/21 20:13:07 hubi74 Exp $

   XTC-Affiliate - Contribution for XT-Commerce http://www.xt-commerce.com
   modified by http://www.netz-designer.de

   Copyright (c) 2003 netz-designer
   -----------------------------------------------------------------------------
   based on:
   (c) 2003 OSC-Affiliate (affiliate_payment.php, v 1.9 2003/09/22);
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

if (!isset($_SESSION['affiliate_id'])) {
    xtc_redirect(xtc_href_link(FILENAME_AFFILIATE, '', 'SSL'));
}

$breadcrumb->add(NAVBAR_TITLE, xtc_href_link(FILENAME_AFFILIATE, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_PAYMENT, xtc_href_link(FILENAME_AFFILIATE_PAYMENT, '', 'SSL'));

if (!isset($_GET['page'])) $_GET['page'] = 1;

$affiliate_payment_raw = "select p.* , s.affiliate_payment_status_name
           from " . TABLE_AFFILIATE_PAYMENT . " p, " . TABLE_AFFILIATE_PAYMENT_STATUS . " s 
           where p.affiliate_payment_status = s.affiliate_payment_status_id 
           and s.affiliate_language_id = '" . $_SESSION['languages_id'] . "'
           and p.affiliate_id =  '" . $_SESSION['affiliate_id'] . "'
           order by p.affiliate_payment_id DESC";

$affiliate_payment_split = new splitPageResults($affiliate_payment_raw, $_GET['page'], MAX_DISPLAY_SEARCH_RESULTS);

require(DIR_WS_INCLUDES . 'header.php');

$smarty->assign('affiliate_payment_split_number', $affiliate_payment_split->number_of_rows);

$affiliate_payment_table = '';

if ($affiliate_payment_split->number_of_rows > 0) {
	$affiliate_payment_values = xtc_db_query($affiliate_payment_split->sql_query);
    $number_of_payment = 0;
    while ($affiliate_payment = xtc_db_fetch_array($affiliate_payment_values)) {
    	$number_of_payment++;
    	
        if (($number_of_payment / 2) == floor($number_of_payment / 2)) {
        	$affiliate_payment_table .= '<tr class="productListing-even">';
        }
		else {
			$affiliate_payment_table .= '<tr class="productListing-odd">';
		}
		
		$affiliate_payment_table .= '<td class="smallText" align="right">' . $affiliate_payment['affiliate_payment_id'] . '</td>';
		$affiliate_payment_table .= '<td class="smallText" align="center">' . xtc_date_short($affiliate_payment['affiliate_payment_date']) . '</td>';
		$affiliate_payment_table .= '<td class="smallText" align="right">' . $currencies->display_price($affiliate_payment['affiliate_payment_total'], '') . '</td>';
		$affiliate_payment_table .= '<td class="smallText" align="right">' . $affiliate_payment['affiliate_payment_status_name'] . '</td>';
	}
	$smarty->assign('affiliate_payment_table', $affiliate_payment_table);
}

if ($affiliate_payment_split->number_of_rows > 0) {
	$smarty->assign('affiliate_payment_split_count', $affiliate_payment_split->display_count(TEXT_DISPLAY_NUMBER_OF_PAYMENTS));
	$smarty->assign('affiliate_payment_split_link', $affiliate_payment_split->display_links(MAX_DISPLAY_PAGE_LINKS, xtc_get_all_get_params(array('page', 'info', 'x', 'y'))));
}

$affiliate_payment_values = xtc_db_query("select sum(affiliate_payment_total) as total from " . TABLE_AFFILIATE_PAYMENT . " where affiliate_id = '" . $_SESSION['affiliate_id'] . "'");
$affiliate_payment = xtc_db_fetch_array($affiliate_payment_values);

$smarty->assign('affiliate_payment_total', $currencies->display_price($affiliate_payment['total'], ''));
$smarty->assign('language', $_SESSION['language']);
$smarty->caching = 0;
$main_content=$smarty->fetch(CURRENT_TEMPLATE . '/module/affiliate_payment.html');
$smarty->assign('main_content',$main_content);

$smarty->assign('language', $_SESSION['language']);
$smarty->caching = 0;
$smarty->display(CURRENT_TEMPLATE . '/index.html');?>