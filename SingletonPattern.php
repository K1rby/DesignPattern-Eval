<?php

class BaseDeDonnee {

    private static $_instance = null;
    private $_record ='';
    private $_name ='';

    /**
     * @return string
     */
    public function __toString() {

        return $this->editRecord() .' '. strtoupper($this->getName());
    }

    /**
     * BaseDeDonnee constructor.
     * @param $name
     * @param $record
     */
    private function __construct($name, $record) {

        $this->_name = $name;
        $this->_record = $record;
    }

    /**
     * @param $name
     * @param $record
     *
     * @return BaseDeDonnee|null
     */
    public static function getInstance($name, $record) {

        if(is_null(self::$_instance)) {
            self::$_instance = new BaseDeDonnee($name, $record);
        }

        return self::$_instance;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->_name;
    }

    /**
     * @return string
     */
    public function editRecord() {
        return $this->_record;
    }
}

// Instanciation de l'objet
$bdd = BaseDeDonnee::getInstance('nomBDD','2');

// Appel implicite à la méthode __toString()
echo $bdd->getName();
echo $bdd;
