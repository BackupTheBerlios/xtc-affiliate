<?php
/*------------------------------------------------------------------------------
   $Id: affiliate_german.php,v 1.2 2005/05/25 18:20:23 hubi74 Exp $

   XTC-Affiliate - Contribution for XT-Commerce http://www.xt-commerce.com
   modified by http://www.netz-designer.de

   Copyright (c) 2003 netz-designer
   -----------------------------------------------------------------------------
   based on:
   (c) 2003 OSC-Affiliate (affiliate_german.php, v 1.12 2003/08/18);
   http://oscaffiliate.sourceforge.net/

   Contribution based on:

   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 - 2003 osCommerce

   Released under the GNU General Public License
   ---------------------------------------------------------------------------*/

define('BOX_INFORMATION_AFFILIATE', 'Partnerprogramm');
define('BOX_AFFILIATE_INFO', 'Partner Informationen');
define('BOX_AFFILIATE_SUMMARY', 'Partnerkonto &Uuml;bersicht');
define('BOX_AFFILIATE_ACCOUNT', 'Partnerkonto bearbeiten');
define('BOX_AFFILIATE_CLICKRATE', '&Uuml;bersicht Klicks');
define('BOX_AFFILIATE_PAYMENT', 'Provisionszahlungen');
define('BOX_AFFILIATE_SALES', '&Uuml;bersicht Verk&auml;ufe');
define('BOX_AFFILIATE_BANNERS', 'Banner');
define('BOX_AFFILIATE_CONTACT', 'Kontakt');
define('BOX_AFFILIATE_FAQ', 'FAQ');
define('BOX_AFFILIATE_LOGIN', 'Partner Anmeldung');
define('BOX_AFFILIATE_LOGOUT', 'Abmelden');

define('ENTRY_AFFILIATE_ACCEPT_AGB', 'Bitte best&auml;tigen Sie, dass Sie mit unseren <a href="%s" target="_blank">AGB</a> einverstanden sind.');
define('ENTRY_AFFILIATE_AGB_ERROR', '&nbsp;<small><font color="#FF0000">Sie m&uuml;ssen sich mit unseren AGB einverstanden erkl&auml;ren.</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_CHECK_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_CHECK_ERROR', '&nbsp;<small><font color="#FF0000">erforderlich</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_PAYPAL_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_PAYPAL_ERROR', '&nbsp;<small><font color="#FF0000">erforderlich</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_BANK_NAME_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_BANK_NAME_ERROR', '&nbsp;<small><font color="#FF0000">erforderlich</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_BANK_ACCOUNT_NAME_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_BANK_ACCOUNT_NAME_ERROR', '&nbsp;<small><font color="#FF0000">erforderlich</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_BANK_ACCOUNT_NUMBER_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_BANK_ACCOUNT_NUMBER_ERROR', '&nbsp;<small><font color="#FF0000">erforderlich</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_BANK_BRANCH_NUMBER_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_BANK_BRANCH_NUMBER_ERROR', '&nbsp;<small><font color="#FF0000">erforderlich</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_BANK_SWIFT_CODE_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_BANK_SWIFT_CODE_ERROR', '&nbsp;<small><font color="#FF0000">erforderlich</font></small>');
define('ENTRY_AFFILIATE_COMPANY_TEXT', '');
define('ENTRY_AFFILIATE_COMPANY_ERROR', '&nbsp;<small><font color="#FF0000">erforderlich</font></small>');
define('ENTRY_AFFILIATE_COMPANY_TAXID_TEXT', '');
define('ENTRY_AFFILIATE_COMPANY_TAXID_ERROR', '&nbsp;<small><font color="#FF0000">erforderlich</font></small>');
define('ENTRY_AFFILIATE_HOMEPAGE_TEXT', '&nbsp;<small><font color="#000000"> (http://)</font></small>');
define('ENTRY_AFFILIATE_HOMEPAGE_ERROR', '&nbsp;<small><font color="#FF0000">erforderlich (http://)</font></small>');

define('CATEGORY_PAYMENT_DETAILS','Auszahlung kann erfolgen &uuml;ber');

define('TEXT_AFFILIATE_PERIOD', 'Periode: ');
define('TEXT_AFFILIATE_STATUS', 'Status: ');
define('TEXT_AFFILIATE_LEVEL', 'Level: ');
define('TEXT_AFFILIATE_ALL_PERIODS', 'Alle Perioden');
define('TEXT_AFFILIATE_ALL_STATUS', 'Alle Statuse');
define('TEXT_AFFILIATE_ALL_LEVELS', 'Alle Levels');
define('TEXT_AFFILIATE_PERSONAL_LEVEL', 'Personal');
define('TEXT_AFFILIATE_LEVEL_SUFFIX', 'Level ');
define('TEXT_AFFILIATE_NAME', 'Bannername: ');
define('TEXT_AFFILIATE_INFO', 'Kopieren Sie den HTML Code und f&uuml;gen Sie diesen in Ihrer Webseite ein.');
define('TEXT_DISPLAY_NUMBER_OF_CLICKS', 'angezeigte Klicks <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)');
define('TEXT_DISPLAY_NUMBER_OF_SALES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Verk&auml;ufen)');
define('TEXT_DISPLAY_NUMBER_OF_PAYMENTS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> payments)');
define('TEXT_DELETED_ORDER_BY_ADMIN', 'Gel&ouml;scht (Admin)');
define('TEXT_AFFILIATE_PERSONAL_LEVEL_SHORT', 'Pers.');
define('TEXT_COMMISSION_LEVEL_TIER', 'Level: ');
define('TEXT_COMMISSION_RATE_TIER', 'Provision: ');
define('TEXT_COMMISSION_TIER_COUNT', 'Verkäufe: ');
define('TEXT_COMMISSION_TIER_TOTAL', 'Summe: ');
define('TEXT_COMMISSION_TIER', 'Provisionsbetrag: ');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Neues Passwort zum Partnerprogramm');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Über die Adresse ' . $REMOTE_ADDR . ' haben wir eine Anfrage zur Passworterneuerung für Ihren Zugang zum Partnerprogramm erhalten.' . "\n\n" . 'Ihr neues Passwort für Ihren Zugang zum Partnerprogramm von \'' . STORE_NAME . '\' lautet ab sofort:' . "\n\n" . '   %s' . "\n\n");

define('MAIL_AFFILIATE_SUBJECT', 'Willkommen zum Partnerprogramm von' . STORE_NAME);
define('MAIL_AFFILIATE_HEADER', 'Verehrter Partner

Vielen Dank für Ihre Anmeldung bei unserem Partnerprogramm.

Ihre Anmeldeinformationen:
**************************

');
define('MAIL_AFFILIATE_ID', 'Ihre Partner-ID ist: ');
define('MAIL_AFFILIATE_USERNAME', 'Ihr Benutzername ist: ');
define('MAIL_AFFILIATE_PASSWORD', 'Ihr Passwort ist: ');
define('MAIL_AFFILIATE_LINK', 'Melden Sie sich hier an: ');
define('MAIL_AFFILIATE_FOOTER', 'Wir freuen uns auf eine gute Zusammenarbeit mit Ihnen!

Ihr Partnerprogramm Team');

define('EMAIL_SUBJECT', 'Partnerprogramm');

define('NAVBAR_TITLE', 'Partnerprogramm');
define('NAVBAR_TITLE_AFFILIATE', 'Login');
define('NAVBAR_TITLE_BANNERS', 'Banner');
define('NAVBAR_TITLE_CLICKS', 'Clicks');
define('NAVBAR_TITLE_CONTACT', 'Kontakt');
define('NAVBAR_TITLE_DETAILS', 'Daten ändern');
define('NAVBAR_TITLE_DETAILS_OK', 'Daten geändert');
define('NAVBAR_TITLE_FAQ', 'Fragen');
define('NAVBAR_TITLE_INFO', 'Informationen');
define('NAVBAR_TITLE_LOGOUT', 'Logout');
define('NAVBAR_TITLE_PASSWORD_FORGOTTEN', 'Passwort vergessen');
define('NAVBAR_TITLE_PAYMENT', 'Auszahlung');
define('NAVBAR_TITLE_SALES', 'Verkäufe');
define('NAVBAR_TITLE_SIGNUP', 'Anmelden');
define('NAVBAR_TITLESIGNUP_OK', 'Angemeldet');
define('NAVBAR_TITLE_SUMMARY', 'Übersicht');
define('NAVBAR_TITLE_TERMS', 'Bedingungen');

define('IMAGE_BANNERS', 'Partner Banner');
define('IMAGE_CLICKTHROUGHS', 'Bericht &uuml;ber Klicks');
define('IMAGE_SALES', 'Bericht &uuml;ber Verk&auml;ufe');
?>
