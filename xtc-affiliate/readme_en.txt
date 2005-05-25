<?php
/*------------------------------------------------------------------------------
   $Id: readme_en.txt,v 1.6 2005/05/25 18:20:23 hubi74 Exp $

   XTC-Affiliate - Contribution for XT-Commerce http://www.xt-commerce.com
   modified by http://www.netz-designer.de

   Copyright (c) 2003 netz-designer
   -----------------------------------------------------------------------------
   based on:
   (c) 2003 OSC-Affiliate
   http://oscaffiliate.sourceforge.net/

   Contribution based on:

   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 - 2003 osCommerce

   Released under the GNU General Public License
   -------------------------------------------------------------------------*/?>

*** Installation ***

The first step should be like everytime a backup of your database.

Hereafter just perform the following steps in their given order:

1) The database-file affiliate.sql has to be inserted into the database by an
   adequate Administration-Tool. (e.g. phpMyAdmin)
2) Copy all files of the project into your shop. The folder-structure is the same
   as of a standard XTC installation.
3) Just make the following changes to some original xtc files. (please make a
   backup of them first)
   
   --> includes/application_top.php
	   add these lines at the end of the file (before the last ?>):
	       // inclusion for affiliate program
	       require(DIR_WS_INCLUDES . 'affiliate_application_top.php');
	       
  -->  checkout_process.php
	   before the following lines:
           // load the after_process function from the payment modules
  		   $payment_modules->after_process();
	   add these lines:
		   // inclusion for affiliate program
		   require(DIR_WS_INCLUDES . 'affiliate_checkout_process.php');
	       
  --> admin/includes/application_top.php
	  add these lines at the end of the file (before the last ?>):
		   // inclusion for affiliate program
		   require(DIR_WS_INCLUDES . 'affiliate_application_top.php');
		   
  --> admin/includes/column_left.php
	  add these lines at the end of the file (before the last ?>):
		   // inclusion for affiliate program
		   require(DIR_WS_INCLUDES . 'affiliate_column_left.php');
		   
  --> lang/german/german.php
      add these lines at the end of the file (before the last ?>):
		  // inclusion for affiliate program
		  require(DIR_WS_LANGUAGES . $_SESSION['language'].'/'.'affiliate_german.php');
		  
  --> lang/german/admin/german.php
      add these lines at the end of the file (before the last ?>):
		  // inclusion for affiliate program
		  require(DIR_FS_LANGUAGES . $_SESSION['language'].'/admin/'.'affiliate_german.php');
		  
  --> lang/german/admin/configuration.php
	  add these lines at the end of the file (before the last ?>):
		  // inclusion for affiliate program
		  require(DIR_FS_LANGUAGES . $_SESSION['language'].'/admin/'.'affiliate_configuration.php');

  --> lang/english/english.php
      add these lines at the end of the file (before the last ?>):
		  // inclusion for affiliate program
		  require(DIR_WS_LANGUAGES . $_SESSION['language'].'/'.'affiliate_english.php');

  --> lang/english/admin/english.php
      add these lines at the end of the file (before the last ?>):
		  // inclusion for affiliate program
		  require(DIR_FS_LANGUAGES . $_SESSION['language'].'/admin/'.'affiliate_english.php');

  --> lang/english/admin/configuration.php
	  add these lines at the end of the file (before the last ?>):
		  // inclusion for affiliate program
		  require(DIR_FS_LANGUAGES . $_SESSION['language'].'/admin/'.'affiliate_configuration.php');

  --> templates/xtc2/index.html
	  after the following line: (or wherever in your template)
          {$box_WHATSNEW}
	  add these line:
		  {$box_AFFILIATE}

  --> templates/xtc2/source/boxes.php
	  before the following line:
           $smarty->assign('tpl_path',DIR_WS_CATALOG.'templates/'.CURRENT_TEMPLATE.'/');
	  add these lines:
		   // inclusion for affiliate program
		   require(DIR_WS_BOXES . 'affiliate.php');

		  
4) Login as the admin and go to the admin section, where you can configure your
   affiliate program. In the content manager of XTC you can insert your terms
   and conditions, your affiliate information and your FAQs.
   
So, thats all. Have a lot of fun with this affiliate program.

********************************************************************************

Andreas Oberzier * http://www.netz-designer.de * Projectmanager

Bugreport:     bugs.xtc@netz-designer.de
Updates:       http://developer.sourceforge.de/projects/xtc-affiliate
Unterst�tzung: http://www.amazon.de/exec/obidos/wishlist/274LZDWMJGI9R

********************************************************************************


		  
********  CREDITS from OSC-AFFILIATE  **********
Henri Schmidhuber IN-Solution   	http://www.in-solution.de	(Developer, Project Manager)
	Unterst�tzt uns via PayPal:  	https://www.paypal.com/xclick/business=henri%40in-solution.de
	Amazon.de Wunschzettel: 	http://www.amazon.de/exec/obidos/wishlist/EQKIUJPZ63E2

Steve Kemp   Snowtech Services  	http://www.snowtech.com.au	(Developer)
	Donate via PayPal:  		https://www.paypal.com/xclick/business=info%40alpinehosting.net

Ron Seigel							(Beta-Tester)

Buttons made by: Hubert Keil 		http://www.win-vermieter.de/osc/

Thomas Pl�nkers  TheMedia       	http://themedia.at              (osC-Dev. Team Member)
        Unterst�tzung via PayPal: 	https://www.paypal.com/xclick/business=tp%40themedia.at
	Amazon.de Wunschzettel:   	http://www.amazon.de/exec/obidos/wishlist/10UZX1DSFAEVD
