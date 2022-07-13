<?php

include_once 'lanche.php';

class cardapio {

    private $lanches;
    private $bebidas;
    private $adicionais;

    public function __construct() {
        $this->lanches = [];
    }

    public function addLanche($lanche) {
        if ($lanche != null) {
            $this->lanches = array_merge($this->lanches, [$lanche]);
        }
    }

    public function deleteLanche($lanche) {
        $ar = [];
        foreach ($this->lanches as $l) {
            if ($l != $lanche) {
                $ar[] = $l;
            }
        }
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
    }

}
