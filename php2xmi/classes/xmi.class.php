<?php
/**
* @author    Ben <chris@mogelpackung.de>
* @version   0.1
* @package   Core
* @since     0.1
*/

  function boolval($value)
  {
    return ($value == 1) ? 'true' : 'false';
  }

  /**
  * transforms mysql reflection data into xmi v2.0
  *
  * this hack includes some delicious dontdos and
  * will only run with PoseidonCE (free) because
  * i only tested with it (:
  * this as an early alpha without any documentation
  *
  * @package  Documentation-UML
  * @author   Ben <chris@mogelpackung.de>
  * @version  0.1
  */
  class XMIWriter
  {
    private $connection = null;
    private $xmi = '';
    private $ext = array();
    private $imp = array();
    public $packages = true;
    private $cli = false;


    function XMIWriter($connection)
    {
      $this->connection = $connection;
      $this->cli = (php_sapi_name() == 'cli') ? true : false;
    }

    public function message($msg)
    {
      if ($this->cli)
      {
        print "$msg\n";
      } else
      {
        print "$msg<br>";
      }
    }

    private function &fetchSingle($sql)
    {
      $result = mysql_query($sql,$this->connection);
      if (!$result)
      {
        $this->message($sql." failed with error : ".mysql_error());
        return false;
      }
      $row = mysql_fetch_array($result);
      return $row;
    }


    private function &fetchMultiple($sql)
    {
      $result = mysql_query($sql,$this->connection);
      if (!$result)
      {
        $this->message($sql." failed with error : ".mysql_error());
        return false;
      }
      $rows = array();
      while($row = mysql_fetch_array($result))
      {
        $rows[] = $row;
      }
      return $rows;
    }


    private function addExtends($parent,$child)
    {
      $this->ext[$child] = $parent;
      return "$child:extends:$parent";
    }


    private function addImplements($interface,$class)
    {
      $this->imp[$class][] = $interface;
      return "$class:implements:$interface";
    }


    private function generateHeader()
    {
      $this->xmi.= "<?xml version = '1.0' encoding = 'UTF-8' ?>\n";
      $this->xmi.= "<XMI xmi.version = '1.2' xmlns:UML = 'org.omg.xmi.namespace.UML' timestamp = 'Mon Apr 26 14:47:55 CEST 2004'>\n";
      $this->xmi.= "  <XMI.header>\n";
      $this->xmi.= "    <XMI.documentation>\n";
      $this->xmi.= "      <XMI.exporter>PHP2XMI</XMI.exporter>\n";
      $this->xmi.= "      <XMI.exporterVersion>0.1</XMI.exporterVersion>\n";
      $this->xmi.= "    </XMI.documentation>\n";
      $this->xmi.= "  </XMI.header>\n";
      $this->xmi.= "  <XMI.content>\n";
      $this->xmi.= "    <UML:Model xmi.id = 'model' name = 'model' isSpecification = 'false' isRoot = 'false' isLeaf = 'false' isAbstract = 'false'>\n";
      $this->xmi.= "      <UML:Namespace.ownedElement>\n";
    }


    private function generateFooter()
    {
      $this->xmi.= "        <!-- PHP Types -->\n";
      $this->xmi.= "        <UML:Package xmi.id = 'php:types' name = 'php' isSpecification = 'false' isRoot = 'false' isLeaf = 'false' isAbstract = 'false'>\n";
      $this->xmi.= "          <UML:Namespace.ownedElement>\n";
      $this->xmi.= "            <UML:DataType xmi.id = 'php:types:int' name = 'int' isSpecification = 'false' isRoot = 'false' isLeaf = 'false' isAbstract = 'false'/>\n";
      $this->xmi.= "            <UML:DataType xmi.id = 'php:types:void' name = 'void' isSpecification = 'false' isRoot = 'false' isLeaf = 'false' isAbstract = 'false'/>\n";
      $this->xmi.= "            <UML:DataType xmi.id = 'php:types:bool' name = 'bool' isSpecification = 'false' isRoot = 'false' isLeaf = 'false' isAbstract = 'false'/>\n";
      $this->xmi.= "            <UML:DataType xmi.id = 'php:types:string' name = 'string' isSpecification = 'false' isRoot = 'false' isLeaf = 'false' isAbstract = 'false'/>\n";
      $this->xmi.= "            <UML:DataType xmi.id = 'php:types:array' name = 'array' isSpecification = 'false' isRoot = 'false' isLeaf = 'false' isAbstract = 'false'/>\n";
      $this->xmi.= "            <UML:DataType xmi.id = 'php:types:mixed' name = 'mixed' isSpecification = 'false' isRoot = 'false' isLeaf = 'false' isAbstract = 'false'/>\n";
      $this->xmi.= "          </UML:Namespace.ownedElement>\n";
      $this->xmi.= "        </UML:Package>\n";
      $this->xmi.= "        <UML:Stereotype xmi.id = 'sterotype:implement' name = 'implement' isSpecification = 'false' isRoot = 'false' isLeaf = 'false' isAbstract = 'false'>\n";
      $this->xmi.= "          <UML:Stereotype.baseClass>Abstraction</UML:Stereotype.baseClass>\n";
      $this->xmi.= "        </UML:Stereotype>\n";
      $this->xmi.= "      </UML:Namespace.ownedElement>\n";
      $this->xmi.= "    </UML:Model>\n";
      $this->xmi.= "  </XMI.content>\n";
      $this->xmi.= "</XMI>\n";
    }


    private function generateExtends()
    {
      $this->xmi.= "        <!-- Extends -->\n";
      foreach($this->ext as $child => $parent)
      {
        $type = (strpos($parent,'interface:')!==false) ? 'Interface' : 'Class';
        $this->xmi.= "        <UML:Generalization xmi.id = '$parent:extends:$child' isSpecification = 'false'>\n";
        $this->xmi.= "          <UML:Generalization.child>\n";
        $this->xmi.= "            <UML:$type xmi.idref = '$child'/>\n";
        $this->xmi.= "          </UML:Generalization.child>\n";
        $this->xmi.= "          <UML:Generalization.parent>\n";
        $this->xmi.= "            <UML:$type xmi.idref = '$parent'/>\n";
        $this->xmi.= "          </UML:Generalization.parent>\n";
        $this->xmi.= "        </UML:Generalization>\n";
      }
    }


    private function generateImplements()
    {
      $this->xmi.= "        <!-- Implements -->\n";
      foreach($this->imp as $class => $interfaces)
      {
        foreach($interfaces as $interface)
        {
          $this->xmi.= "        <UML:Abstraction xmi.id = '$class:implements:$interface' name = '' isSpecification = 'false'>\n";
          $this->xmi.= "          <UML:ModelElement.stereotype>\n";
          $this->xmi.= "            <UML:Stereotype xmi.idref = 'sterotype:implement'/>\n";
          $this->xmi.= "          </UML:ModelElement.stereotype>\n";
          $this->xmi.= "          <UML:Dependency.client>\n";
          $this->xmi.= "            <UML:Class xmi.idref = '$class'/>\n";
          $this->xmi.= "          </UML:Dependency.client>\n";
          $this->xmi.= "          <UML:Dependency.supplier>\n";
          $this->xmi.= "            <UML:Interface xmi.idref = '$interface'/>\n";
          $this->xmi.= "          </UML:Dependency.supplier>\n";
          $this->xmi.= "        </UML:Abstraction>\n";
        }
      }
    }


    private function mapType($type)
    {
      if (in_array($type,array('void','int','bool','string','array','mixed')))
      {
        $type = 'php:types:'.$type;
      } else
      {
        //check interface
        $interface = $this->fetchSingle("SELECT name FROM interface WHERE name = '$type'");
        if ($interface)
        {
          $type = 'interface:'.$type;
        } else
        {
          //check class
          $class = $this->fetchSingle("SELECT name FROM class WHERE name = '$type'");
          if ($class)
          {
            $type = 'class:'.$type;
          } else
          {
            $type = 'php:types:void';
          }
        }
      }
      return $type;
    }


    private function generateProperty($name,$owner)
    {
      $property = $this->fetchSingle("SELECT * FROM class_property WHERE name = '$name' AND owner = '$owner'");
      if (!$property) return false;

      //property
      $type = ($property['type'] != '') ? $property['type'] : 'mixed';
      $type = $this->mapType($type);
      $ownerScope = ($property['static'] == 1) ? 'classifier' : 'instance';
      $this->xmi.= "          <!-- Property $owner::$name -->\n";
      $this->xmi.= "          <UML:Attribute xmi.id = 'method:$owner:$name' name = '$name' visibility = '".$property['visibility']."' isSpecification = 'false' ownerScope = '$ownerScope' changeability = 'changeable'>\n";
      $this->xmi.= "            <UML:StructuralFeature.type>\n";
      $this->xmi.= "              <UML:DataType xmi.idref = '$type'/>\n";
      $this->xmi.= "            </UML:StructuralFeature.type>\n";
      $this->xmi.= "          </UML:Attribute>\n";
    }


    private function generateMethod($name,$owner)
    {
      $method = $this->fetchSingle("SELECT * FROM method WHERE name = '$name' AND owner = '$owner'");
      if (!$method) return false;

      if ($method['reference'] == 1)
      {
        $displayname = '&amp;'.$name;
      } else
      {
        $displayname = $name;
      }

      //Method
      $this->xmi.= "          <!-- Method $owner::$name -->\n";
      $this->xmi.= "          <UML:Operation xmi.id = 'method:$owner:$name' name = '$displayname' ";
      $this->xmi.= "visibility = '".$method['visibility']."' isSpecification = 'false' ownerScope = 'instance' ";
      $this->xmi.= "isQuery = 'false' concurrency = 'sequential' isRoot = 'false' isLeaf = '".boolval($method['final'])."' isAbstract = '".boolval($method['abstract'])."'>\n";
      $this->xmi.= "            <UML:BehavioralFeature.parameter>\n";

      //Params
      $params = $this->fetchMultiple("SELECT * FROM method_param WHERE method = '$name' AND owner = '$owner' ORDER BY position");
      if ($params)
      {
        foreach($params as $param)
        {
          $type = ($param['type'] != '') ? $param['type'] : 'mixed';
          $type = $this->mapType($type);
          if ($param['reference'] == 1)
          {
            $param['name'] = '&amp;'.$param['name'];
          }
          $this->xmi.= "              <UML:Parameter xmi.id = 'method:$owner:$name:param:{$param['name']}' name = '{$param['name']}' isSpecification = 'false' kind = 'in'>\n";
          $this->xmi.= "                <UML:Parameter.type>\n";
          $this->xmi.= "                  <UML:DataType xmi.idref = '{$type}'/>\n";
          $this->xmi.= "                  </UML:Parameter.type>\n";
          $this->xmi.= "              </UML:Parameter>\n";
        }
      }
      //Return
      $type = ($method['return'] != '') ? $method['return'] : 'mixed';
      $type = $this->mapType($type);
      $this->xmi.= "              <UML:Parameter xmi.id = 'method:$owner:$name:param:return' name = 'return' isSpecification = 'false' kind = 'return'>\n";
      $this->xmi.= "                <UML:Parameter.type>\n";
      $this->xmi.= "                  <UML:DataType xmi.idref = '{$type}'/>\n";
      $this->xmi.= "                  </UML:Parameter.type>\n";
      $this->xmi.= "              </UML:Parameter>\n";

      //Method
      $this->xmi.= "            </UML:BehavioralFeature.parameter>\n";
      $this->xmi.= "          </UML:Operation>\n";
    }


    private function generateInterface($name)
    {
      $interface = $this->fetchSingle("SELECT * FROM interface WHERE name = '$name'");
      if (!$interface) return false;

      $this->message("  - generating interface $name");

      //Interface
      $this->xmi.= "        <!-- Interface $name -->\n";
      $this->xmi.= "        <UML:Interface xmi.id = 'interface:$name' name = '$name' visibility = 'public' isSpecification = 'false' isRoot = 'false' ";
      $this->xmi.= "isLeaf = '".boolval($interface['final'])."' isAbstract = '".boolval($interface['abstract'])."'>\n";

      //extends
      if ($interface['extends'] != '')
      {
        $id = $this->addExtends("interface:{$interface['extends']}","interface:$name");
        $this->xmi.= "          <!-- extends {$interface['extends']} -->\n";
        $this->xmi.= "          <UML:GeneralizableElement.generalization>\n";
        $this->xmi.= "            <UML:Generalization xmi.idref = '$id'/>\n";
        $this->xmi.= "          </UML:GeneralizableElement.generalization>\n";
      }

      $this->xmi.= "          <UML:Classifier.feature>\n";

      //methods
      $methods = $this->fetchMultiple("SELECT name FROM method WHERE owner = '$name'");
      if ($methods)
      {
        foreach($methods as $method)
        {
          $this->generateMethod($method['name'],$name);
        }
      }

      //Interface
      $this->xmi.= "          </UML:Classifier.feature>\n";
      $this->xmi.= "        </UML:Interface>\n";
    }


    private function generateClass($name)
    {
      $class = $this->fetchSingle("SELECT * FROM class WHERE name = '$name'");
      if (!$class) return false;

      $this->message("  - generating class $name");

      //Interface
      $this->xmi.= "        <!-- Class $name -->\n";
      $this->xmi.= "        <UML:Class xmi.id = 'class:$name' name = '$name' visibility = 'public' isSpecification = 'false' isRoot = 'false' ";
      $this->xmi.= "isLeaf = '".boolval($class['final'])."' isAbstract = '".boolval($class['abstract'])."'>\n";

      //extends
      if ($class['extends'] != '')
      {
        $id = $this->addExtends("class:{$class['extends']}","class:$name");
        $this->xmi.= "          <!-- extends {$class['extends']} -->\n";
        $this->xmi.= "          <UML:GeneralizableElement.generalization>\n";
        $this->xmi.= "            <UML:Generalization xmi.idref = '$id'/>\n";
        $this->xmi.= "          </UML:GeneralizableElement.generalization>\n";
      }

      //implements
      $implements = $this->fetchMultiple("SELECT interface FROM class_implement WHERE class = '$name'");
      if ($implements)
      {
        foreach($implements as $implement)
        {
          $id = $this->addImplements("interface:{$implement['interface']}","class:$name");
          $this->xmi.= "          <UML:ModelElement.clientDependency>\n";
          $this->xmi.= "            <UML:Abstraction xmi.idref = '$id'/>\n";
          $this->xmi.= "          </UML:ModelElement.clientDependency>\n";
        }
      }

      $this->xmi.= "          <UML:Classifier.feature>\n";

      //properties
      $properties = $this->fetchMultiple("SELECT name FROM class_property WHERE owner = '$name'");
      if ($properties)
      {
        foreach($properties as $property)
        {
          $this->generateProperty($property['name'],$name);
        }
      }

      //methods
      $methods = $this->fetchMultiple("SELECT name FROM method WHERE owner = '$name'");
      if ($methods)
      {
        foreach($methods as $method)
        {
          $this->generateMethod($method['name'],$name);
        }
      }

      //Interface
      $this->xmi.= "          </UML:Classifier.feature>\n";
      $this->xmi.= "        </UML:Class>\n";
    }


    public function generatePackage($name)
    {
      $this->message("");
      $this->message("- generating package $name");

      $this->xmi.= "        <!-- Package : $name -->\n";
      $this->xmi.= "        <UML:Package xmi.id = 'package:$name' name = '$name' isSpecification = 'false' isRoot = 'false' isLeaf = 'false' isAbstract = 'false'>\n";
      $this->xmi.= "          <UML:Namespace.ownedElement>\n";

      $interfaces = $this->fetchMultiple("SELECT name FROM interface WHERE package = '$name'");
      foreach($interfaces as $interface)
      {
        $this->generateInterface($interface['name']);
      }

      $classes = $this->fetchMultiple("SELECT name FROM class WHERE package = '$name'");
      foreach($classes as $class)
      {
        $this->generateClass($class['name']);
      }

      $this->xmi.= "          </UML:Namespace.ownedElement>\n";
      $this->xmi.= "        </UML:Package>\n";
    }


    public function generate()
    {
      $this->generateHeader();

      if ($this->packages == true)
      {
        //Get Packages
        $packages = array();
        $packagesClass = $this->fetchMultiple("SELECT DISTINCT package FROM class");
        foreach($packagesClass as $package)
        {
          $packages[$package['package']] = true;
        }
        $packagesInterface = $this->fetchMultiple("SELECT DISTINCT package FROM interface");
        foreach($packagesInterface as $package)
        {
          $packages[$package['package']] = true;
        }
        //Generate
        foreach($packages as $package => $crap)
        {
          $this->generatePackage($package);
        }
      } else
      {
        //Get All
        $interfaces = $this->fetchMultiple("SELECT name FROM interface");
        foreach($interfaces as $interface)
        {
          $this->generateInterface($interface['name']);
        }

        $classes = $this->fetchMultiple("SELECT name FROM class");
        foreach($classes as $class)
        {
          $this->generateClass($class['name']);
        }
      }
      $this->generateExtends();
      $this->generateImplements();
      $this->generateFooter();
      $this->message("");
      $this->message("...done");
    }


    public function saveToFile($filename)
    {
      if (!$fp = fopen($filename, 'w'))
      {
        trigger_error("Cannot open file for writing ($filename)", E_USER_ERROR);
        return false;
      }

      if (!fwrite($fp, $this->xmi))
      {
        fclose($fp);
        trigger_error("Cannot write to file ($filename)", E_USER_ERROR);
        return false;
      }

      return true;
    }
  }
?>