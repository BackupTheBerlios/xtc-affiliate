# ------------------------------------------------------------------------------
#  $Id: affiliate.sql,v 1.1 2003/12/21 20:13:07 hubi74 Exp $
#
#  XTC-Affiliate - Contribution for XT-Commerce http://www.xt-commerce.com
#  modified by http://www.netz-designer.de
#
#  Copyright (c) 2003 netz-designer
#  -----------------------------------------------------------------------------
#  based on:
#  (c) 2003 OSC-Affiliate (affiliate.sql, v 1.24 2003/09/17);
#  http://oscaffiliate.sourceforge.net/
#
#  Contribution based on:
#
#  osCommerce, Open Source E-Commerce Solutions
#  http://www.oscommerce.com
#
#  Copyright (c) 2002 - 2003 osCommerce
#
#  Released under the GNU General Public License
#
# NOTE: * Please make any modifications to this file by hand!
#       * DO NOT use a mysqldump created file for new changes!
#       * Please take note of the table structure, and use this
#         structure as a standard for future modifications!
#       * Any tables you add here should be added in admin/backup.php
#         and in catalog/install/includes/functions/database.php
#       * To see the 'diff'erence between MySQL databases, use
#         the mysqldiff perl script located in the extras
#         directory of the 'catalog' module.
#       * Comments should be like these, full line comments.
#         (don't use inline comments)

DROP TABLE IF EXISTS affiliate_affiliate;
CREATE TABLE affiliate_affiliate (
  affiliate_id int(11) NOT NULL auto_increment,
  affiliate_lft int(11) NOT NULL,
  affiliate_rgt int(11) NOT NULL,
  affiliate_root int(11) NOT NULL,
  affiliate_gender char(1) NOT NULL default '',
  affiliate_firstname varchar(32) NOT NULL default '',
  affiliate_lastname varchar(32) NOT NULL default '',
  affiliate_dob datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_email_address varchar(96) NOT NULL default '',
  affiliate_telephone varchar(32) NOT NULL default '',
  affiliate_fax varchar(32) NOT NULL default '',
  affiliate_password varchar(40) NOT NULL default '',
  affiliate_homepage varchar(96) NOT NULL default '',
  affiliate_street_address varchar(64) NOT NULL default '',
  affiliate_suburb varchar(64) NOT NULL default '',
  affiliate_city varchar(32) NOT NULL default '',
  affiliate_postcode varchar(10) NOT NULL default '',
  affiliate_state varchar(32) NOT NULL default '',
  affiliate_country_id int(11) NOT NULL default '0',
  affiliate_zone_id int(11) NOT NULL default '0',
  affiliate_agb tinyint(4) NOT NULL default '0',
  affiliate_company varchar(60) NOT NULL default '',
  affiliate_company_taxid varchar(64) NOT NULL default '',
  affiliate_commission_percent DECIMAL(4,2) NOT NULL default '0.00',
  affiliate_payment_check varchar(100) NOT NULL default '',
  affiliate_payment_paypal varchar(64) NOT NULL default '',
  affiliate_payment_bank_name varchar(64) NOT NULL default '',
  affiliate_payment_bank_branch_number varchar(64) NOT NULL default '',
  affiliate_payment_bank_swift_code varchar(64) NOT NULL default '',
  affiliate_payment_bank_account_name varchar(64) NOT NULL default '',
  affiliate_payment_bank_account_number varchar(64) NOT NULL default '',
  affiliate_date_of_last_logon datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_number_of_logons int(11) NOT NULL default '0',
  affiliate_date_account_created datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_date_account_last_modified datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (affiliate_id),
  KEY `affiliate_root` (`affiliate_root`),
  KEY `affiliate_rgt` (`affiliate_rgt`),
  KEY `affiliate_lft` (`affiliate_lft`)
);

DROP TABLE IF EXISTS affiliate_banners;
CREATE TABLE affiliate_banners (
  affiliate_banners_id int(11) NOT NULL auto_increment,
  affiliate_banners_title varchar(64) NOT NULL default '',
  affiliate_products_id int(11) NOT NULL default '0',
  affiliate_banners_image varchar(64) NOT NULL default '',
  affiliate_banners_group varchar(10) NOT NULL default '',
  affiliate_banners_html_text text,
  affiliate_expires_impressions int(7) default '0',
  affiliate_expires_date datetime default NULL,
  affiliate_date_scheduled datetime default NULL,
  affiliate_date_added datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_date_status_change datetime default NULL,
  affiliate_status int(1) NOT NULL default '1',
  PRIMARY KEY  (affiliate_banners_id)
);

DROP TABLE IF EXISTS affiliate_banners_history;
CREATE TABLE affiliate_banners_history (
  affiliate_banners_history_id int(11) NOT NULL auto_increment,
  affiliate_banners_products_id int(11) NOT NULL default '0',
  affiliate_banners_id int(11) NOT NULL default '0',
  affiliate_banners_affiliate_id int(11) NOT NULL default '0',
  affiliate_banners_shown int(11) NOT NULL default '0',
  affiliate_banners_clicks tinyint(4) NOT NULL default '0',
  affiliate_banners_history_date date NOT NULL default '0000-00-00',
  PRIMARY KEY  (affiliate_banners_history_id,affiliate_banners_products_id)
);

DROP TABLE IF EXISTS affiliate_clickthroughs;
CREATE TABLE affiliate_clickthroughs (
  affiliate_clickthrough_id int(11) NOT NULL auto_increment,
  affiliate_id int(11) NOT NULL default '0',
  affiliate_clientdate datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_clientbrowser varchar(200) default 'Could Not Find This Data',
  affiliate_clientip varchar(50) default 'Could Not Find This Data',
  affiliate_clientreferer varchar(200) default 'none detected (maybe a direct link)',
  affiliate_products_id int(11) default '0',
  affiliate_banner_id int(11) NOT NULL default '0',
  PRIMARY KEY  (affiliate_clickthrough_id),
  KEY refid (affiliate_id)
);

DROP TABLE IF EXISTS affiliate_payment;
CREATE TABLE affiliate_payment (
  affiliate_payment_id int(11) NOT NULL auto_increment,
  affiliate_id int(11) NOT NULL default '0',
  affiliate_payment decimal(15,2) NOT NULL default '0.00',
  affiliate_payment_tax decimal(15,2) NOT NULL default '0.00',
  affiliate_payment_total decimal(15,2) NOT NULL default '0.00',
  affiliate_payment_date datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_payment_last_modified datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_payment_status int(5) NOT NULL default '0',
  affiliate_firstname varchar(32) NOT NULL default '',
  affiliate_lastname varchar(32) NOT NULL default '',
  affiliate_street_address varchar(64) NOT NULL default '',
  affiliate_suburb varchar(64) NOT NULL default '',
  affiliate_city varchar(32) NOT NULL default '',
  affiliate_postcode varchar(10) NOT NULL default '',
  affiliate_country varchar(32) NOT NULL default '0',
  affiliate_company varchar(60) NOT NULL default '',
  affiliate_state varchar(32) NOT NULL default '0',
  affiliate_address_format_id int(5) NOT NULL default '0',
  affiliate_last_modified datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (affiliate_payment_id)
);

DROP TABLE IF EXISTS affiliate_payment_status;
CREATE TABLE affiliate_payment_status (
  affiliate_payment_status_id int(11) NOT NULL default '0',
  affiliate_language_id int(11) NOT NULL default '1',
  affiliate_payment_status_name varchar(32) NOT NULL default '',
  PRIMARY KEY  (affiliate_payment_status_id,affiliate_language_id),
  KEY idx_affiliate_payment_status_name (affiliate_payment_status_name)
);

DROP TABLE IF EXISTS affiliate_payment_status_history;
CREATE TABLE affiliate_payment_status_history (
  affiliate_status_history_id int(11) NOT NULL auto_increment,
  affiliate_payment_id int(11) NOT NULL default '0',
  affiliate_new_value int(5) NOT NULL default '0',
  affiliate_old_value int(5) default NULL,
  affiliate_date_added datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_notified int(1) default '0',
  PRIMARY KEY  (affiliate_status_history_id)
);

DROP TABLE IF EXISTS affiliate_sales;
CREATE TABLE affiliate_sales (
  affiliate_id int(11) NOT NULL default '0',
  affiliate_date datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_browser varchar(100) NOT NULL default '',
  affiliate_ipaddress varchar(20) NOT NULL default '',
  affiliate_orders_id int(11) NOT NULL default '0',
  affiliate_value decimal(15,2) NOT NULL default '0.00',
  affiliate_payment decimal(15,2) NOT NULL default '0.00',
  affiliate_clickthroughs_id int(11) NOT NULL default '0',
  affiliate_billing_status int(5) NOT NULL default '0',
  affiliate_payment_date datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_payment_id int(11) NOT NULL default '0',
  affiliate_percent  DECIMAL(4,2)  NOT NULL default '0.00',
  affiliate_salesman int(11) NOT NULL default '0',
  affiliate_level tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (affiliate_id,affiliate_orders_id)
);

INSERT INTO affiliate_payment_status VALUES (0, 1, 'Pending');
INSERT INTO affiliate_payment_status VALUES (0, 2, 'Offen');
INSERT INTO affiliate_payment_status VALUES (0, 3, 'Pendiente');
INSERT INTO affiliate_payment_status VALUES (1, 1, 'Paid');
INSERT INTO affiliate_payment_status VALUES (1, 2, 'Ausgezahlt');
INSERT INTO affiliate_payment_status VALUES (1, 3, 'Pagado');

INSERT INTO configuration_group VALUES (900, 'Affiliate Program', 'Options for the Affiliate Program', 50, 1);
INSERT INTO configuration VALUES ('', 'AFFILIATE_EMAIL_ADDRESS', 'affiliate@localhost.com', 900, 1, NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'AFFILIATE_PERCENT', '10.0000', 900, 2, NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'AFFILIATE_THRESHOLD', '50.00', 900, 3, NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'AFFILIATE_COOKIE_LIFETIME', '7200', 900, 4, NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'AFFILIATE_BILLING_TIME', '30', 900, 5, NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'AFFILIATE_PAYMENT_ORDER_MIN_STATUS', '3', 900, 6, NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'AFFILIATE_USE_CHECK', 'true', 900, 7, NULL, now(), NULL,'xtc_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES ('', 'AFFILIATE_USE_PAYPAL', 'true', 900, 8, NULL, now(), NULL,'xtc_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES ('', 'AFFILIATE_USE_BANK', 'true', 900, 9, NULL, now(), NULL,'xtc_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES ('', 'AFFILATE_INDIVIDUAL_PERCENTAGE', 'true', 900, 10, NULL, now(), NULL,'xtc_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES ('', 'AFFILATE_USE_TIER', 'false', 900, 11, NULL, now(), NULL,'xtc_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES ('', 'AFFILIATE_TIER_LEVELS', '0', 900, 12, NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'AFFILIATE_TIER_PERCENTAGE', '8.00;5.00;1.00', 900, 13, NULL, now(), NULL, NULL);

# Set the admin permissions to access the affiliate sites
ALTER TABLE admin_access ADD affiliate_affiliates INTEGER(1);
ALTER TABLE admin_access ADD affiliate_banners INTEGER(1);
ALTER TABLE admin_access ADD affiliate_clicks INTEGER(1);
ALTER TABLE admin_access ADD affiliate_contact INTEGER(1);
ALTER TABLE admin_access ADD affiliate_invoice INTEGER(1);
ALTER TABLE admin_access ADD affiliate_payment INTEGER(1);
ALTER TABLE admin_access ADD affiliate_popup_image INTEGER(1);
ALTER TABLE admin_access ADD affiliate_sales INTEGER(1);
ALTER TABLE admin_access ADD affiliate_statistics INTEGER(1);
ALTER TABLE admin_access ADD affiliate_summary INTEGER(1);
UPDATE admin_access SET affiliate_affiliates=1 WHERE customers_id=1;
UPDATE admin_access SET affiliate_banners=1 WHERE customers_id=1;
UPDATE admin_access SET affiliate_clicks=1 WHERE customers_id=1;
UPDATE admin_access SET affiliate_contact=1 WHERE customers_id=1;
UPDATE admin_access SET affiliate_invoice=1 WHERE customers_id=1;
UPDATE admin_access SET affiliate_payment=1 WHERE customers_id=1;
UPDATE admin_access SET affiliate_popup_image=1 WHERE customers_id=1;
UPDATE admin_access SET affiliate_sales=1 WHERE customers_id=1;
UPDATE admin_access SET affiliate_statistics=1 WHERE customers_id=1;
UPDATE admin_access SET affiliate_summary=1 WHERE customers_id=1;

# Insert the file_flags for the Content Manager
INSERT INTO cm_file_flags VALUES (900, 'affiliate');

# Insert some needed Content to the content manager
# german Stuff
INSERT INTO content_manager VALUES ('', 0, 0, 2, 'Partner AGB', 'Unsere Affiliate AGB', 'Tragen Sie <STRONG>hier</STRONG> Ihre <EM><U>allgemeinen Geschäftsbedingungen</U></EM> für Ihr Partnerprogramm ein.', 900, '', 1, 900, 0);
INSERT INTO content_manager VALUES ('', 0, 0, 2, 'Affiliate Info', 'Affiliate Informationen', 'Tragen Sie <STRONG>hier</STRONG> Ihre <EM><U>Informationen zum Affiliate Programm</U></EM> ein.', 900, '', 1, 901, 0);
INSERT INTO content_manager VALUES ('', 0, 0, 2, 'Affiliate FAQ', 'Häufig gestellte Fragen', 'Tragen Sie <STRONG>hier</STRONG> Ihre <EM><U>FAQ zum Affiliate Programm</U></EM> ein.', 900, '', 1, 902, 0);
# english stuff
INSERT INTO content_manager VALUES ('', 0, 0, 1, 'Partner T&C', 'Our Affiliate Terms and Conditions', 'Put in <STRONG>here</STRONG> your <EM><U>terms and conditions</U></EM> for your affiliate program.', 900, '', 1, 900, 0);
INSERT INTO content_manager VALUES ('', 0, 0, 1, 'Affiliate Info', 'Affiliate Information', 'Put in <STRONG>here</STRONG> your <EM><U>information about your affiliate program</U></EM>.', 900, '', 1, 901, 0);
INSERT INTO content_manager VALUES ('', 0, 0, 1, 'Affiliate FAQ', 'Frequently Asked Questions', 'Put in <STRONG>here</STRONG> some <EM><U>FAQ for your affiliate program</U></EM>.', 900, '', 1, 902, 0);
