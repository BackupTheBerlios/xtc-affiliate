<?php
/*------------------------------------------------------------------------------
   $Id: affiliate_banners.php,v 1.1 2003/12/21 20:13:07 hubi74 Exp $

   XTC-Affiliate - Contribution for XT-Commerce http://www.xt-commerce.com
   modified by http://www.netz-designer.de

   Copyright (c) 2003 netz-designer
   -----------------------------------------------------------------------------
   based on:
   (c) 2003 OSC-Affiliate (affiliate_banners.php, v 1.13 2003/02/27);
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
require_once(DIR_FS_INC . 'xtc_draw_textarea_field.inc.php');

// include boxes
require(DIR_WS_INCLUDES.'boxes.php');

if (!isset($_SESSION['affiliate_id'])) {
    xtc_redirect(xtc_href_link(FILENAME_AFFILIATE, '', 'SSL'));
}

$breadcrumb->add(NAVBAR_TITLE, xtc_href_link(FILENAME_AFFILIATE, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_BANNERS, xtc_href_link(FILENAME_AFFILIATE_BANNERS));

$affiliate_banners_values = xtc_db_query("select * from " . TABLE_AFFILIATE_BANNERS . " order by affiliate_banners_title");

require(DIR_WS_INCLUDES . 'header.php');

$smarty->assign('affiliate_banners_title', $affiliate_banners['affiliate_banners_title']);
$smarty->assign('FORM_ACTION', xtc_draw_form('individual_banner', xtc_href_link(FILENAME_AFFILIATE_BANNERS)));
$smarty->assign('INPUT_BANNER_ID', xtc_draw_input_field('individual_banner_id', '', 'size="5"'));
$smarty->assign('BUTTON_SUBMIT', xtc_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE));

if (xtc_not_null($_POST['individual_banner_id']) || xtc_not_null($_GET['individual_banner_id'])) {
    if (xtc_not_null($_POST['individual_banner_id'])) $individual_banner_id = $_POST['individual_banner_id'];
    if ($_GET['individual_banner_id']) $individual_banner_id = $_GET['individual_banner_id'];
    $affiliate_pbanners_values = xtc_db_query("select p.products_image, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . $individual_banner_id . "' and pd.products_id = '" . $individual_banner_id . "' and p.products_status = '1' and pd.language_id = '" . $_SESSION['languages_id'] . "'");
    if ($affiliate_pbanners = xtc_db_fetch_array($affiliate_pbanners_values)) {
        switch (AFFILIATE_KIND_OF_BANNERS) {
            case 1:
                $link = '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_PRODUCT_INFO . '?ref=' . $_SESSION['affiliate_id'] . '&products_id=' . $individual_banner_id . '&affiliate_banner_id=1" target="_blank"><img src="' . HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . $affiliate_pbanners['affiliate_banners_image'] . '" border="0" alt="' . $affiliate_pbanners['products_name'] . '"></a>';
                break;
            case 2: // Link to Products
                $link = '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_PRODUCT_INFO . '?ref=' . $_SESSION['affiliate_id'] . '&products_id=' . $individual_banner_id . '&affiliate_banner_id=1" target="_blank"><img src="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_AFFILIATE_SHOW_BANNER . '?ref=' . $_SESSION['affiliate_id'] . '&affiliate_pbanner_id=' . $individual_banner_id . '" border="0" alt="' . $affiliate_pbanners['products_name'] . '"></a>';
                break;
        }
    }
    $smarty->assign('link1', $link);
    $smarty->assign('TEXTAREA_AFFILIATE_BANNER1', xtc_draw_textarea_field('affiliate_banner', 'soft', '60', '6', $link));
}
$banner_table_content = '';
if (xtc_db_num_rows($affiliate_banners_values)) {
    while ($affiliate_banners = xtc_db_fetch_array($affiliate_banners_values)) {
        $affiliate_products_query = xtc_db_query("select products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . $affiliate_banners['affiliate_products_id'] . "' and language_id = '" . $_SESSION['languages_id'] . "'");
        $affiliate_products = xtc_db_fetch_array($affiliate_products_query);
        $prod_id = $affiliate_banners['affiliate_products_id'];
        $ban_id = $affiliate_banners['affiliate_banners_id'];
        switch (AFFILIATE_KIND_OF_BANNERS) {
            case 1: // Link to Products
                if ($prod_id > 0) {
                    $link = '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_PRODUCT_INFO . '?ref=' . $_SESSION['affiliate_id'] . '&products_id=' . $prod_id . '&affiliate_banner_id=' . $ban_id . '" target="_blank"><img src="' . HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . $affiliate_banners['affiliate_banners_image'] . '" border="0" alt="' . $affiliate_products['products_name'] . '"></a>';
                }
                else { // generic_link
                    $link = '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_DEFAULT . '?ref=' . $_SESSION['affiliate_id'] . '&affiliate_banner_id=' . $ban_id . '" target="_blank"><img src="' . HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . $affiliate_banners['affiliate_banners_image'] . '" border="0" alt="' . $affiliate_banners['affiliate_banners_title'] . '"></a>';
                }
                break;
            case 2: // Link to Products
                if ($prod_id > 0) {
                    $link = '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_PRODUCT_INFO . '?ref=' . $_SESSION['affiliate_id'] . '&products_id=' . $prod_id . '&affiliate_banner_id=' . $ban_id . '" target="_blank"><img src="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_AFFILIATE_SHOW_BANNER . '?ref=' . $_SESSION['affiliate_id'] . '&affiliate_banner_id=' . $ban_id . '" border="0" alt="' . $affiliate_products['products_name'] . '"></a>';
                }
                else { // generic_link
                    $link = '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_DEFAULT . '?ref=' . $_SESSION['affiliate_id'] . '&affiliate_banner_id=' . $ban_id . '" target="_blank"><img src="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_AFFILIATE_SHOW_BANNER . '?ref=' . $_SESSION['affiliate_id'] . '&affiliate_banner_id=' . $ban_id . '" border="0" alt="' . $affiliate_banners['affiliate_banners_title'] . '"></a>';
                }
                break;
        }
        $banner_table_content .= '<tr>';
        $banner_table_content .= '<td><table width="100%" border="0" cellspacing="0" cellpadding="2">';
        $banner_table_content .= '<tr><td class="infoBoxHeading" align="center">' . TEXT_AFFILIATE_NAME . ' ' . $affiliate_banners['affiliate_banners_title'] . '</td></tr>';
        $banner_table_content .= '<tr><td class="smallText" align="center"><br>' . $link . '</td></tr>';
        $banner_table_content .= '<tr><td class="smallText" align="center">' . TEXT_AFFILIATE_INFO . '</td></tr>';
        $banner_table_content .= '<tr><td class="smallText" align="center">' . xtc_draw_textarea_field('affiliate_banner', 'soft', '60', '6', $link) . '</td></tr>';
        $banner_table_content .= '</table></td></tr>';
    }
    $smarty->assign('banner_table_content', $banner_table_content);
}
$smarty->assign('language', $_SESSION['language']);
$smarty->caching = 0;
$main_content=$smarty->fetch(CURRENT_TEMPLATE . '/module/affiliate_banners.html');
$smarty->assign('main_content',$main_content);

$smarty->assign('language', $_SESSION['language']);
$smarty->caching = 0;
$smarty->display(CURRENT_TEMPLATE . '/index.html');?>
