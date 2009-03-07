<?php
/**
* @author    Ben <chris@mogelpackung.de>
* @version   0.1
* @package   Core
* @since     0.1
*/

  /**
  * persists reflection into mysql
  *
  * this hack includes some delicious dontdos
  * this as an early alpha without any documentations (:
  *
  * @package  Documentation-UML
  * @author   Ben <chris@mogelpackung.de>
  * @version  0.1
  */
  class ReflectorPersistence
  {
    private $connection = null;
    public $internal = true;
    private $cli = false;


    function ReflectorPersistence($connection)
    {
      $this->connection = $connection;
      $this->cli = (php_sapi_name() == 'cli') ? true : false;
      $this->executeSql('TRUNCATE class');
      $this->executeSql('TRUNCATE class_implement');
      $this->executeSql('TRUNCATE class_property');
      $this->executeSql('TRUNCATE interface');
      $this->executeSql('TRUNCATE method');
      $this->executeSql('TRUNCATE method_param');
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

    private function executeSql($sql)
    {
      $result = mysql_query($sql,$this->connection);
      if (!$result)
      {
        $this->message($sql." failed with error : ".mysql_error());
        die();
      }
    }


    private function createReplaceQuery($table,&$fields)
    {
      $sql = 'REPLACE INTO '.$table.' (';
      foreach ($fields as $name => $value)
      {
        $sql.= $name.', ';
      }
      $sql = substr($sql,0,-2).')  VALUES (';
      foreach ($fields as $name => $value)
      {
        $sql.= '\''.mysql_escape_string($value).'\', ';
      }
      return substr($sql,0,-2).')';
    }


    private function parseDocumentation($documentation)
    {
      $tags = array();
      $lines = explode("\n",$documentation);

      //skip first and last line
      unset($lines[0]);
      unset($lines[count($lines)]);

      //loop lines
      foreach($lines as $line)
      {
        //remove trailing *
        $line = substr(trim($line),1);
        if ($line!='')
        {
          //tag?
          $tagLine = trim($line);
          if ($tagLine[0] == '@')
          {
            $tagPos = strpos($tagLine, ' ');
            $key = trim(substr($tagLine,1,$tagPos));
            //check type
            if (($key == 'param') || ($key == 'returns') || ($key == 'package'))
            {
              $tagLine = trim(substr($tagLine,$tagPos));
              $typePos = strpos($tagLine, ' ');
              if ($typePos > 0 )
              {
                $tags[$key][] = trim(substr($tagLine,0,$typePos));
              } else
              {
                $tags[$key][] = $tagLine;
              }
            }
          }
        }
      }
      return $tags;
    }


    private function &paramToArray(ReflectionParameter &$param)
    {
      $fields = array();
      $fields['name'] = $param->getName();
      $fields['owner'] = '';
      $fields['reference'] = $param->isPassedByReference() ? '1' : '0';
      return $fields;
    }

    private function &propertyToArray(ReflectionProperty &$property)
    {
      $fields = array();
      $fields['name'] = $property->getName();
      $fields['owner'] = $property->getDeclaringClass()->getName();
      $fields['visibility'] = 'public';
      $fields['static'] = $property->isStatic() ? '1' : '0';
      $fields['type'] = 'mixed';
      if ($property->isPrivate()) $fields['visibility'] = 'private';
      if ($property->isProtected()) $fields['visibility'] = 'protected';
      return $fields;
    }


    private function &methodToArray(ReflectionMethod &$method)
    {
      $fields = array();
      $fields['name'] = $method->getName();
      $fields['owner'] = $method->getDeclaringClass()->getName();
      $fields['internal'] = $method->isInternal() ? '1' : '0';
      $fields['abstract'] = $method->isAbstract() ? '1' : '0';
      $fields['final'] = $method->isFinal() ? '1' : '0';
      $fields['visibility'] = 'public';
      $fields['reference'] = $method->returnsReference() ? '1' : '0';
      $fields['constructor'] = 0;
      if ($method->isPrivate()) $fields['visibility'] = 'private';
      if ($method->isProtected()) $fields['visibility'] = 'protected';
      if ($method->isConstructor()) $fields['constructor'] = 1;
      $fields['documentation'] = $method->getDocComment();

      $tags = $this->parseDocumentation($fields['documentation']);
      if (isset($tags['returns']))
      {
        $fields['return'] = $tags['returns'][0];
      }

      return $fields;
    }


    private function &classToArray(ReflectionClass &$class)
    {
      $fields = array();
      $fields['name'] = $class->getName();
      $fields['internal'] = $class->isInternal() ? '1' : '0';
      $fields['abstract'] = $class->isAbstract() ? '1' : '0';
      $fields['final'] = $class->isFinal() ? '1' : '0';
      $fields['extends'] = '';
      if ($class->getParentClass() != false)
      {
        $fields['extends'] = $class->getParentClass()->name;
      }
      $fields['documentation'] = $class->getDocComment();
      $tags = $this->parseDocumentation($fields['documentation']);
      if (isset($tags['package']))
      {
        $fields['package'] = $tags['package'][0];
      }
      return $fields;
    }


    private function writeProperty(&$property)
    {
      //property
      $fields = &$this->propertyToArray($property);
      $sql = $this->createReplaceQuery('class_property',$fields);
      $this->executeSql($sql);
    }


    private function writeMethod(&$method)
    {
      //method body
      $fields = &$this->methodToArray($method);
      $sql = $this->createReplaceQuery('method',$fields);
      $this->executeSql($sql);
      //method params
      $tags = $this->parseDocumentation($method->getDocComment());
      $params = $method->getParameters();
      $position = 0;
      foreach($params as $param)
      {
        $position++;
        $fields = &$this->paramToArray($param);
        $fields['method'] = $method->getName();
        $fields['owner'] = $method->getDeclaringClass()->getName();
        $fields['position'] = $position;
        $fields['type'] = (isset($tags['param'][$position-1])) ? $tags['param'][$position-1] : 'mixed';
        $sql = $this->createReplaceQuery('method_param',$fields);
        $this->executeSql($sql);
      }
    }



    private function writeClass(&$class)
    {
      //class body
      $fields = &$this->classToArray($class);
      $sql = $this->createReplaceQuery('class',$fields);
      $this->executeSql($sql);

      //class implements
      $interfaces = $class->getInterfaces();
      $fields = array('class'=>$class->getName(),'interface'=>'');
      foreach($interfaces as $interface)
      {
        $fields['interface'] = $interface->name;
        $sql = $this->createReplaceQuery('class_implement',$fields);
        $this->executeSql($sql);
      }

      //methods
      $methods = $class->getMethods();
      foreach($methods as $method)
      {
        $this->writeMethod($method);
      }

      //properties
      $properties = $class->getProperties();
      foreach($properties as $property)
      {
        $this->writeProperty($property);
      }
    }


    private function writeInterface(&$interface)
    {
      $fields = &$this->classToArray($interface);

      //extends
      $interfaces = $interface->getInterfaces();
      if (count($interfaces) > 0)
      {
        $fields['extends'] = $interfaces[0]->name;
      }

      $sql = $this->createReplaceQuery('interface',$fields);
      $this->executeSql($sql);

      //methods
      $methods = $interface->getMethods();
      foreach($methods as $method)
      {
        $this->writeMethod($method);
      }
    }


    public function addClass(ReflectionClass &$class)
    {
      if ((!$this->internal) && ($class->isInternal())) return false;
      if ($class->getName() == 'ReflectorPersistence') return false;
      $this->message("- adding class ".$class->getName());
      $this->writeClass($class);
    }


    public function addInterface(ReflectionClass &$interface)
    {
      if ((!$this->internal) && ($interface->isInternal())) return false;
      $this->message("- adding interface ".$interface->getName());
      $this->writeInterface($interface);
    }

  }
?>