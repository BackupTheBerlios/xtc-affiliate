<?php
/*------------------------------------------------------------------------------
   $Id: affiliate.php,v 1.1 2004/04/08 14:19:12 hubi74 Exp $

   XTC-Affiliate - Contribution for XT-Commerce http://www.xt-commerce.com
   modified by http://www.netz-designer.de

   Copyright (c) 2003 netz-designer
   -----------------------------------------------------------------------------
   based on:
   (c) 2003 OSC-Affiliate (affiliate.php, v 1.6 2003/02/22);
   http://oscaffiliate.sourceforge.net/

   Contribution based on:

   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 - 2003 osCommerce

   Released under the GNU General Public License
   ---------------------------------------------------------------------------*/

$box_smarty = new smarty;
$box_content='';
$box_smarty->assign('tpl_path',DIR_WS_CATALOG.'templates/'.CURRENT_TEMPLATE.'/');

if (isset($_SESSION['affiliate_id'])) {
    $box_content .= '<a href="' . xtc_href_link(FILENAME_AFFILIATE_SUMMARY, '', 'SSL') . '">' . BOX_AFFILIATE_SUMMARY . '</a><br>';
    $box_content .= '<a href="' . xtc_href_link(FILENAME_AFFILIATE_ACCOUNT, '', 'SSL'). '">' . BOX_AFFILIATE_ACCOUNT . '</a><br>';
    $box_content .= '<a href="' . xtc_href_link(FILENAME_AFFILIATE_PAYMENT, '', 'SSL'). '">' . BOX_AFFILIATE_PAYMENT . '</a><br>';
    $box_content .= '<a href="' . xtc_href_link(FILENAME_AFFILIATE_CLICKS, '', 'SSL'). '">' . BOX_AFFILIATE_CLICKRATE . '</a><br>';
    $box_content .= '<a href="' . xtc_href_link(FILENAME_AFFILIATE_SALES, '', 'SSL'). '">' . BOX_AFFILIATE_SALES . '</a><br>';
    $box_content .= '<a href="' . xtc_href_link(FILENAME_AFFILIATE_BANNERS). '">' . BOX_AFFILIATE_BANNERS . '</a><br>';
    $box_content .= '<a href="' . xtc_href_link(FILENAME_AFFILIATE_CONTACT). '">' . BOX_AFFILIATE_CONTACT . '</a><br>';
    $box_content .= '<a href="' . xtc_href_link(FILENAME_CONTENT, 'coID=902'). '">' . BOX_AFFILIATE_FAQ . '</a><br>';
    $box_content .= '<a href="' . xtc_href_link(FILENAME_AFFILIATE_LOGOUT). '">' . BOX_AFFILIATE_LOGOUT . '</a>';
}
else {
	$box_content .= '<a href="' . xtc_href_link(FILENAME_CONTENT,'coID=901'). '">' . BOX_AFFILIATE_INFO . '</a><br>';
	$box_content .= '<a href="' . xtc_href_link(FILENAME_AFFILIATE, '', 'SSL') . '">' . BOX_AFFILIATE_LOGIN . '</a>';
}
//$box_smarty->assign('BOX_TITLE', BOX_HEADING_ADD_PRODUCT_ID);
$box_smarty->assign('BOX_CONTENT', $box_content);
$box_smarty->assign('language', $_SESSION['language']);

// set cache ID
$box_smarty->caching = 0;
$box_affiliate = $box_smarty->fetch(CURRENT_TEMPLATE.'/boxes/box_affiliate.html');
$smarty->assign('box_AFFILIATE',$box_affiliate);
?>
