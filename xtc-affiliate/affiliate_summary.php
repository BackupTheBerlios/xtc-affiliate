<?php
/*------------------------------------------------------------------------------
   $Id: affiliate_summary.php,v 1.3 2004/11/16 13:34:56 hubi74 Exp $

   XTC-Affiliate - Contribution for XT-Commerce http://www.xt-commerce.com
   modified by http://www.netz-designer.de

   Copyright (c) 2003 netz-designer
   -----------------------------------------------------------------------------
   based on:
   (c) 2003 OSC-Affiliate (affiliate_summary.php, v 1.17 2003/09/17);
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
require_once(DIR_FS_INC . 'affiliate_period.inc.php');
require_once(DIR_FS_INC . 'affiliate_level_statistics_query.inc.php');
require_once(DIR_FS_INC . 'xtc_image_button.inc.php');
require_once(DIR_FS_INC . 'xtc_round.inc.php');

// include boxes
require(DIR_FS_CATALOG .'templates/'.CURRENT_TEMPLATE. '/source/boxes.php');

if (!isset($_SESSION['affiliate_id'])) {
    xtc_redirect(xtc_href_link(FILENAME_AFFILIATE, '', 'SSL'));
}

$breadcrumb->add(NAVBAR_TITLE, xtc_href_link(FILENAME_AFFILIATE, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_SUMMARY, xtc_href_link(FILENAME_AFFILIATE_SUMMARY));
  
$affiliate_raw = "select sum(affiliate_banners_shown) as banner_count, "
                   . "count(affiliate_clickthrough_id) as clickthrough_count, "
                   . "MONTH(affiliate_date_account_created) as start_month, "
                   . "YEAR(affiliate_date_account_created) as start_year, "
                   . "a.affiliate_commission_percent, a.affiliate_firstname, a.affiliate_id, affiliate_lastname "
                   . "from " . TABLE_AFFILIATE . " AS a "
                   . "LEFT JOIN " . TABLE_AFFILIATE_CLICKTHROUGHS . " AS ac ON ( a.affiliate_id = ac.affiliate_id )"
                   . "LEFT JOIN " . TABLE_AFFILIATE_BANNERS_HISTORY . " AS ab ON ( a.affiliate_id = ab.affiliate_banners_affiliate_id )"
                   . " where a.affiliate_id  = '" . $_SESSION['affiliate_id'] . "'"
                   . " GROUP BY a.affiliate_date_account_created, a.affiliate_commission_percent, a.affiliate_firstname, affiliate_lastname ";
$affiliate_query = xtc_db_query( $affiliate_raw );
$affiliate = xtc_db_fetch_array($affiliate_query);
$smarty->assign('affiliate', $affiliate);

$affiliate_impressions = $affiliate['banner_count'];
if ($affiliate_impressions == 0) $affiliate_impressions="n/a";
$smarty->assign('affiliate_impressions', $affiliate_impressions);

$smarty->assign('period_selector', affiliate_period( 'a_period', $affiliate['start_year'], $affiliate['start_month'], true, xtc_db_prepare_input( $_GET['a_period'] ), 'onChange="this.form.submit();"' ));

$affiliate_percent = 0;
$affiliate_percent = $affiliate['affiliate_commission_percent'];
if ($affiliate_percent < AFFILIATE_PERCENT) $affiliate_percent = AFFILIATE_PERCENT;
$smarty->assign('affiliate_percent', xtc_round($affiliate_percent, 2));

$affiliate_percent_tier = split(";", AFFILIATE_TIER_PERCENTAGE, AFFILIATE_TIER_LEVELS );

if ( (empty($_GET['a_period'])) or ( $_GET['a_period'] == "all" ) ) {
    $affiliate_sales = affiliate_level_statistics_query( $_SESSION['affiliate_id'] );
}
else {
    $affiliate_sales = affiliate_level_statistics_query( $_SESSION['affiliate_id'], xtc_db_prepare_input( $_GET['a_period'] ) );
}

$smarty->assign('affiliate_transactions', xtc_not_null($affiliate_sales['count']) ? $affiliate_sales['count'] : 0);

if ($affiliate_clickthroughs > 0) {
	$affiliate_conversions = xtc_round(($affiliate_transactions / $affiliate_clickthroughs) * 100, 2) . "%";
}
else {
    $affiliate_conversions = "n/a";
}
$smarty->assign('affiliate_conversions', $affiliate_conversions);

$smarty->assign('affiliate_amount', $xtPrice->xtcFormat($affiliate_sales['total'], true));

if ($affiliate_transactions > 0) {
	$affiliate_average = xtc_round($affiliate_amount / $affiliate_transactions, 2);
	$affiliate_average = $xtPrice->xtcFormat($affiliate_average, true);
}
else {
	$affiliate_average = "n/a";
}
$smarty->assign('affiliate_average', $affiliate_average);

$smarty->assign('affiliate_commission', $xtPrice->xtcFormat($affiliate_sales['payment'], true));;

require(DIR_WS_INCLUDES . 'header.php');

$smarty->assign('FORM_ACTION', xtc_draw_form('period', xtc_href_link(FILENAME_AFFILIATE_SUMMARY ), 'get', 'SSL' ));

$smarty->assign('LINK_IMPRESSION', '<a href="javascript:popupWindow(\'' . xtc_href_link(FILENAME_AFFILIATE_HELP_1) . '\')">');
$smarty->assign('LINK_VISIT', '<a href="javascript:popupWindow(\'' . xtc_href_link(FILENAME_AFFILIATE_HELP_2) . '\')">');
$smarty->assign('LINK_TRANSACTIONS', '<a href="javascript:popupWindow(\'' . xtc_href_link(FILENAME_AFFILIATE_HELP_3) . '\')">');
$smarty->assign('LINK_CONVERSION', '<a href="javascript:popupWindow(\'' . xtc_href_link(FILENAME_AFFILIATE_HELP_4) . '\')">');
$smarty->assign('LINK_AMOUNT', '<a href="javascript:popupWindow(\'' . xtc_href_link(FILENAME_AFFILIATE_HELP_5) . '\')">');
$smarty->assign('LINK_AVERAGE', '<a href="javascript:popupWindow(\'' . xtc_href_link(FILENAME_AFFILIATE_HELP_6) . '\')">');
$smarty->assign('LINK_COMISSION_RATE', '<a href="javascript:popupWindow(\'' . xtc_href_link(FILENAME_AFFILIATE_HELP_7) . '\')">');
$smarty->assign('LINK_COMISSION', '<a href="javascript:popupWindow(\'' . xtc_href_link(FILENAME_AFFILIATE_HELP_8) . '\')">');

if ( AFFILATE_USE_TIER == 'true' ) {
	$smarty->assign('AFFILIATE_USE_TIER', 'true');
	
    for ($tier_number = 0; $tier_number <= AFFILIATE_TIER_LEVELS; $tier_number++ ) {
    	if (is_null($affiliate_percent_tier[$tier_number - 1])) {
    		$affiliate_percent_tier[$tier_number - 1] = $affiliate_percent;
    	}
    	$affiliate_percent_tier_table .= '<tr>';
    	$affiliate_percent_tier_table .= '<td width="15%" class="boxtext"><a href=' . xtc_href_link(FILENAME_AFFILIATE_SALES, 'a_level=' . $tier_number . '&a_period=' . $a_period, 'SSL') . '>' . TEXT_COMMISSION_LEVEL_TIER . $tier_number . '</a></td>';
    	$affiliate_percent_tier_table .= '<td width="15%" align="right" class="boxtext"><a href=' . xtc_href_link(FILENAME_AFFILIATE_SALES, 'a_level=' . $tier_number . '&a_period=' . $a_period, 'SSL') . '>' . TEXT_COMMISSION_RATE_TIER . '</a></td>';
    	$affiliate_percent_tier_table .= '<td width="5%" class="boxtext">' . xtc_round($affiliate_percent_tier[$tier_number - 1], 2). '%' . '</td>';
    	$affiliate_percent_tier_table .= '<td width="15%" align="right" class="boxtext"><a href=' . xtc_href_link(FILENAME_AFFILIATE_SALES, 'a_level=' . $tier_number . '&a_period=' . $a_period, 'SSL') . '>' . TEXT_COMMISSION_TIER_COUNT . '</a></td>';
    	$affiliate_percent_tier_table .= '<td width="5%" class="boxtext">' . ($affiliate_sales[$tier_number]['count'] > 0 ? $affiliate_sales[$tier_number]['count'] : '0') . '</td>';
    	$affiliate_percent_tier_table .= '<td width="15%" align="right" class="boxtext"><a href=' . xtc_href_link(FILENAME_AFFILIATE_SALES, 'a_level=' . $tier_number . '&a_period=' . $a_period, 'SSL') . '>' . TEXT_COMMISSION_TIER_TOTAL . '</a></td>';
    	$affiliate_percent_tier_table .= '<td width="5%" class="boxtext">' . $xtPrice->xtcFormat($affiliate_sales[$tier_number]['total'], true) . '</td>';
    	$affiliate_percent_tier_table .= '<td width="20%" align="right" class="boxtext"><a href=' . xtc_href_link(FILENAME_AFFILIATE_SALES, 'a_level=' . $tier_number . '&a_period=' . $a_period, 'SSL') . '>' . TEXT_COMMISSION_TIER . '</a></td>';
    	$affiliate_percent_tier_table .= '<td width="5%" class="boxtext">' . $xtPrice->xtcFormat($affiliate_sales[$tier_number]['payment'],true) . '</td>';
    	$affiliate_percent_tier_table .= '</tr>';
	}
	$smarty->assign('affiliate_percent_tier_table', $affiliate_percent_tier_table);
}
$smarty->assign('LINK_BANNER', '<a href="' . xtc_href_link(FILENAME_AFFILIATE_BANNERS) . '">' . xtc_image_button('button_affiliate_banners.gif', IMAGE_BANNERS) . '</a>');
$smarty->assign('LINK_CLICKS', '<a href="' . xtc_href_link(FILENAME_AFFILIATE_CLICKS, '', 'SSL') . '">' . xtc_image_button('button_affiliate_clickthroughs.gif', IMAGE_CLICKTHROUGHS) . '</a>');
$smarty->assign('LINK_SALES', '<a href="' . xtc_href_link(FILENAME_AFFILIATE_SALES, 'a_period=' . $a_period, 'SSL') . '">' . xtc_image_button('button_affiliate_sales.gif', IMAGE_SALES) . '</a>');
$smarty->assign('language', $_SESSION['language']);
$smarty->caching = 0;
$main_content=$smarty->fetch(CURRENT_TEMPLATE . '/module/affiliate_summary.html');
$smarty->assign('main_content',$main_content);

$smarty->assign('language', $_SESSION['language']);
$smarty->caching = 0;
$smarty->display(CURRENT_TEMPLATE . '/index.html');?>
