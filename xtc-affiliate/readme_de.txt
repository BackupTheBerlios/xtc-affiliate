<?php
/*------------------------------------------------------------------------------
   $Id: readme_de.txt,v 1.2 2004/04/05 18:59:11 hubi74 Exp $

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

Der erste Schritt sollte an dieser Stelle immer ein Backup der Datenbank sein.

Anschliessend führen Sie bitte nacheinander die folgenden Schritte durch:

1) Die Datenbankdatei affiliate.sql per Administrationstool in die Datenbank
   einfügen. (z.B. mit phpMyAdmin)
2) Alle Dateien des Projekts in Ihren Shop kopieren. Die Ordnerstruktur stimmt
   mit einer Standardinstallation überein.
3) Änderungen in den folgenden Originaldateien durchführen. (Vorher eine Kopie
   dieser Dateien anlegen)
   
   --> includes/application_top.php
	   am Ende der Datei folgende Zeilen einfügen (vor dem letzten ?>):
	       // inclusion for affiliate program
	       include('affiliate_application_top.php');
	       
  --> templates/xtc/source/includes/boxes.php
	  vor folgende Zeile:
           $smarty->assign('tpl_path',DIR_WS_CATALOG.'templates/'.CURRENT_TEMPLATE.'/');
	  folgende Zeilen einfügen:
		   // inclusion for affiliate program
		   include(DIR_WS_BOXES . 'affiliate.php');
	       
  -->  checkout_process.php
	   nach den folgenden Zeilen:
           // load the after_process function from the payment modules
  		   $payment_modules->after_process();
	   folgende Zeilen einfügen:
		   // inclusion for affiliate program
		   require(DIR_WS_INCLUDES . 'affiliate_checkout_process.php');
	       
  --> admin/includes/application_top.php
	  am Ende der Datei folgende Zeilen einfügen (vor dem letzten ?>):
		   // inclusion for affiliate program
		   include('affiliate_application_top.php');
		   
  --> admin/includes/column_left.php
	  am Ende der Datei folgende Zeilen einfügen (vor dem letzten ?>):
		   // inclusion for affiliate program
		   include('affiliate_column_left.php');
		   
  --> lang/german/german.php
      am Ende der Datei folgende Zeilen einfügen (vor dem letzten ?>):
		  // inclusion for affiliate program
		  include('affiliate_german.php');
		  
  --> lang/german/admin/german.php
      am Ende der Datei folgende Zeilen einfügen (vor dem letzten ?>):
		  // inclusion for affiliate program
		  include('affiliate_german.php');
		  
  --> lang/german/admin/configuration.php
	  am Ende der Datei folgende Zeilen einfügen (vor dem letzten ?>):
		  // inclusion for affiliate program
		  include('affiliate_configuration.php');
		  
  --> lang/english/english.php
      am Ende der Datei folgende Zeilen einfügen (vor dem letzten ?>):
		  // inclusion for affiliate program
		  include('affiliate_english.php');

  --> lang/english/admin/english.php
      am Ende der Datei folgende Zeilen einfügen (vor dem letzten ?>):
		  // inclusion for affiliate program
		  include('affiliate_english.php');

  --> lang/english/admin/configuration.php
	  am Ende der Datei folgende Zeilen einfügen (vor dem letzten ?>):
		  // inclusion for affiliate program
		  include('affiliate_configuration.php');

  --> templates/xtc/index.html
	  nach folgender Zeile: (oder wo auch immer in Ihrem Template)
          {$box_WHATSNEW}
	  folgende Zeile einfügen:
		  {$box_AFFILIATE}
		  
4) Als Administrator einloggen und im Adminbereich das Affiliate Partnerprogramm
   konfiguraieren. Im Content Manager von XTC lassen sich die Texte der AGB, der
   Informationen und der FAQ erstellen.
   
So, das wärs. nun viel Erfolg mit Ihrem Affiliate-Programm.

********************************************************************************

Andreas Oberzier * http://www.netz-designer.de * Projectmanager

Bugreport:     bugs.xtc@netz-designer.de
Updates:       http://developer.sourceforge.de/projects/xtc-affiliate
Unterstützung: http://www.amazon.de/exec/obidos/wishlist/274LZDWMJGI9R

********************************************************************************


		  
********  CREDITS from OSC-AFFILIATE  **********
Henri Schmidhuber IN-Solution   	http://www.in-solution.de	(Developer, Project Manager)
	Unterstützt uns via PayPal:  	https://www.paypal.com/xclick/business=henri%40in-solution.de
	Amazon.de Wunschzettel: 	http://www.amazon.de/exec/obidos/wishlist/EQKIUJPZ63E2

Steve Kemp   Snowtech Services  	http://www.snowtech.com.au	(Developer)
	Donate via PayPal:  		https://www.paypal.com/xclick/business=info%40alpinehosting.net

Ron Seigel							(Beta-Tester)

Buttons made by: Hubert Keil 		http://www.win-vermieter.de/osc/

Thomas Plänkers  TheMedia       	http://themedia.at              (osC-Dev. Team Member)
        Unterstützung via PayPal: 	https://www.paypal.com/xclick/business=tp%40themedia.at
	Amazon.de Wunschzettel:   	http://www.amazon.de/exec/obidos/wishlist/10UZX1DSFAEVD
