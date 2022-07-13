<?php

class usuario {

    private $permissao;
    private $id;
    private $signo;
    private $salt;
    private $historyCache;
    private $token;
    private $vizibilitMap;

    public function __construct() {
        
    }

    public function recebeParametros($array) {
        if (is_array($array)) {
            
        }
    }

    public function __set($atributo, $value) {
        $this->$atributo = $value;
    }

    public function &__get($atributo) {
        return $this->$atributo;
    }

}
