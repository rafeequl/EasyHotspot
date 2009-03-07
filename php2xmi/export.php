<?php
/**
* @author    bendulu <chris@mogelpackung.de>
* @version   0.1
* @package   Core
* @since     0.1
*/

   include_once('classes/xmi.class.php');
   include_once('database.inc.php');

   $xmi = new XMIWriter($connection);
   //Use packages?
   $xmi->packages = true;
   $xmi->message("");
   $xmi->message("starting generation of XMI..");
   $xmi->message("");
   $xmi->generate();
   //adjust to your needs
   if (!$xmi->saveToFile('C:\Dokumente und Einstellungen\Ben\Eigene Dateien\import.xmi'))
   {
     $xmi->message("XMI could not be saved");
   }
?>