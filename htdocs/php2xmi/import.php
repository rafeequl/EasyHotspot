<?php
/**
* @author    Ben <chris@mogelpackung.de>
* @version   0.1
* @package   Core
* @since     0.1
*/

   include_once('classes/persistence.class.php');
   include_once('database.inc.php');

   //Include all classes and interfaces to show up in xmi
   /*define('SYSTEM_CORE','E:\Web\beesystems.de\src\include\core');
   define('SYSTEM_DATASOURCE','E:\Web\beesystems.de\src\include\datasource');
   include_once(SYSTEM_CORE.'/arraycollection.class.php');
   include_once(SYSTEM_CORE.'/arraymap.class.php');
   include_once(SYSTEM_CORE.'/arraylist.class.php');
   include_once(SYSTEM_CORE.'/arraymap.class.php');
   include_once(SYSTEM_CORE.'/systemregistry.class.php');
   include_once(SYSTEM_CORE.'/validation.class.php');
   include_once(SYSTEM_CORE.'/validationrules.class.php');
   include_once(SYSTEM_DATASOURCE.'/datasource.class.php');*/

   $persistence = new ReflectorPersistence($connection);
   //skip internal
   $persistence->internal = true;

   $persistence->message("");
   $persistence->message("starting parsing of classes and interfaces..");
   $persistence->message("");

   //save classes
   $classes = get_declared_classes();
   foreach($classes as $class)
   {
     $reflection = new ReflectionClass($class);
     $persistence->addClass($reflection);
   }

   //save interfaces
   $interfaces = get_declared_interfaces();
   foreach($interfaces as $interface)
   {
     $reflection = new ReflectionClass($interface);
     $persistence->addInterface($reflection);
   }
   $persistence->message("");
   $persistence->message("...done");
?>